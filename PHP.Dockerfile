#build custom php image from php:fpm since additional extensions are required
FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

#install php-gnupg
RUN apt update -y
RUN apt -y install gcc make autoconf libc-dev  pkg-config
RUN apt -y install libgpgme-dev
RUN apt -y install sudo 
RUN apt -y install wget
RUN pecl install gnupg && docker-php-ext-enable gnupg
