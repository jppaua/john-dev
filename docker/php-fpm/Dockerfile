FROM phpdockerio/php72-fpm:latest

#php7.0-pgsql php7.0-sqlite php7.0-redis php7.0-gd php7.0-mbstring 
RUN apt-get update \
    && apt-get -y --no-install-recommends install wget htop php-pgsql php7.2-gd  \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www/john"