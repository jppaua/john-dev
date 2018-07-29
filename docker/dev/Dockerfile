FROM phpdockerio/php72-fpm:latest

RUN apt-get update
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
RUN apt-get install -y build-essential nodejs git git-core libnotify-bin wget 
RUN apt-get install -y apache2-utils siege httpie

RUN groupadd -r docker
RUN useradd -r -g www-data dev
WORKDIR "/var/www/john"

#openjdk-7-jdk php7.0-mbstring php7.0-pgsql php7.0-sqlite php7.0-redis
RUN apt-get update
RUN apt-get -y --no-install-recommends install software-properties-common xvfb php-pgsql php7.2-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

#install headless chrome stuff
RUN wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
RUN dpkg -i --force-depends google-chrome-stable_current_amd64.deb || exit 0
RUN apt-get update
RUN apt-get install -f -y
RUN rm google-chrome-stable_current_amd64.deb
