#!/usr/bin/env bash

# set -o errexit # exit on errors

m_id=$(grep "\$ID = " index.php | grep "kr_\([a-zA-Z0-9_\-]\+\)" -o)
m_id_2=$(echo $m_id | sed 's/_/-/g')

if [ "x$m_id" = "x" ]; then
  echo "[-] Please edit 'index.php' to change \$ID. Then run me again"
  exit 1
fi

limit_app_name_length=30
if [ ${#m_id} -gt $limit_app_name_length ]; then
  echo "[-] Heroku requires a maximum length of $limit_app_name_length characters for the app name. Got '${m_id}', which is ${#m_id} (too long). Change \$ID then run me again"
  exit 1
fi

if [ ! -d "common" ]; then
  rm -rf .git
  git clone git@bitbucket.org:kaamandroffler/smcp-dp-common.git common && rm -rf common/.git
fi

if [ -d "HTML/images/kr_" ]; then
  mv -v "HTML/images/kr_" "HTML/images/$m_id"
fi

composer install

git init .
git add .
git commit -am "init"

heroku apps:create --region eu $m_id_2 --remote heroku
heroku access:add gabriel@kaam.fr
heroku git:remote -a $m_id_2
