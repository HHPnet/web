FROM php:fpm

RUN apt-get update && apt-get install -y libsasl2-dev libpcre3-dev libcurl4-openssl-dev pkg-config libssl-dev \
    && mkdir -p /usr/local/openssl/include/openssl/ \
    && ln -s /usr/include/openssl/evp.h /usr/local/openssl/include/openssl/evp.h \
    && mkdir -p /usr/local/openssl/lib/ \
    && ln -s /usr/lib/x86_64-linux-gnu/libssl.a /usr/local/openssl/lib/libssl.a \
    && ln -s /usr/lib/x86_64-linux-gnu/libssl.so /usr/local/openssl/lib/

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb