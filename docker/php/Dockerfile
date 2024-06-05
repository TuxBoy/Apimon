FROM php:8.2.19-fpm-alpine

RUN addgroup -g 1000 apimon
RUN adduser -G apimon -u 1000 apimon -D
RUN docker-php-ext-install pdo_mysql

RUN cat <<EOS >> /usr/local/etc/php-fpm.d/www.conf
user = apimon
group = apimon
EOS

WORKDIR /home/apimon