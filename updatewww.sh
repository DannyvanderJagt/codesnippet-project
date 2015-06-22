#!/bin/sh
rm -rf codesnippet-project
git clone https://Henri1992:VArell90@github.com/DannyvanderJagt/codesnippet-project.git
cp -r codesnippet-project/src/* var/www
#cp -r codesnippet-project/nodejs/* var/www/node
cp -r var/www/usb/libs var/www/assets/libs
chmod -R 777 /var/www
