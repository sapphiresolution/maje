#!/usr/bin/env bash

command -v php >/dev/null 2>&1 || {
  echo "[-] Command 'php' was not found. Please install PHP on your system"
  exit 1
}

command -v zip >/dev/null 2>&1 || {
  echo "[-] Command 'zip' was not found. Please install ZIP on your system"
  exit 1
}

langs=(FR)

set -o errexit # exit on errors
# set -o nounset # exit on unset vars

dir=HTML
zip_file=HTML

rm -f $dir/*html

PROD_ACTIVATED=false
[ "x$PROD" = "xtrue" ] && PROD_ACTIVATED=true

PROD_ACTIVATED=true

log_file="error.$RANDOM.log"

for lang in "${langs[@]}"; do
  echo -n "# Generating HTML for $lang"

  file_local=$dir/"$lang"_LOCAL_index.html
  file_prod=$dir/"$lang"_PROD_index.html

  upload_activated=$UPLOAD prod_activated=$PROD prod=false lang=$lang php index.php > "$file_local" || rm -f "$file_local"
  upload_activated=$UPLOAD prod_activated=$PROD prod=true lang=$lang php index.php > "$file_prod" || rm -f "$file_prod"

  if [ -e "$file_local" -a -e "$file_prod" ]; then
    echo -n ": done"
    echo
  else
    echo -e "\nError log:\n\tLANG: $lang\n"
    lang=$lang php index.php
    echo
  fi
done

if $PROD_ACTIVATED; then
  rm -f $dir/$zip_file".zip"
  zip $dir/$zip_file".zip" -x "*LOCAL_*.html" -x $dir/index.php -r $dir
  echo $dir/$zip_file".zip"
fi

if [ -e $log_file ]
then
  ( cat $log_file ; rm $log_file )
fi
