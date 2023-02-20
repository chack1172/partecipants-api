@ECHO off
docker build -t random-picker-htaccess .
docker run -p 8082:80 --mount type=bind,source="%cd%",target=/var/www/html random-picker-htaccess
