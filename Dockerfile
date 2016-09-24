FROM php:fpm-alpine

RUN apk update

RUN apk add autoconf openssl-dev g++ make

RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN apk del --purge autoconf openssl-dev g++ make