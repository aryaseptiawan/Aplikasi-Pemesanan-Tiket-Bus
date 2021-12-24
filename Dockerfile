FROM php:7.4-cli
COPY . /usr/src/app
CMD [ "php", "/mail/contact_me.php"]
