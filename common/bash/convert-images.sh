#!/usr/bin/env bash

command -v convert >/dev/null 2>&1 || {
  echo "[-] Command 'convert' was not found. Please install ImageMagick on your system"
  exit 1
}

m_id=$(grep "\$ID = " index.php | grep "kr_\([a-zA-Z0-9_\-]\+\)" -o)
m=(images_to_convert/*.png)

if [ -e "${m[0]}" ]; then
  for i in images_to_convert/*.png; do
    a=$(basename $i .png)
    convert -verbose $i -strip -quality 80% HTML/images/$m_id/$a@2X.jpg
    convert -verbose $i -strip -resize 50% -quality 80% HTML/images/$m_id/$a.jpg
  done
fi

m=(images_to_convert/*.jpg)
if [ -e "${m[0]}" ]; then
  for i in images_to_convert/*.jpg; do
    a=$(basename $i .jpg)
    convert -verbose $i -strip -quality 80% HTML/images/$m_id/$a@2X.jpg
    convert -verbose $i -strip -resize 50% -quality 80% HTML/images/$m_id/$a.jpg
  done
fi

exit 0
