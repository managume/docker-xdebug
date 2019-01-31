# Docker base image
FROM ubuntu:18.04

ARG PHP_VERSION
ARG APP_NAME

# Update ubuntu repo indexes
RUN apt update --fix-missing && apt upgrade -y

# Install utils
RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo "UTC" > /etc/timezone
RUN apt install -y apt-utils git rsync nano vim unzip curl wget software-properties-common mysql-client

# Add Ondrej repositories
RUN add-apt-repository ppa:ondrej/php
RUN add-apt-repository ppa:ondrej/apache2
RUN apt-get update

# Install multiversion PHP
RUN apt-get install -y php$PHP_VERSION

# Install Apache2
RUN apt-get install -y apache2

# Install PHP extensions
RUN apt-get install -y -m   php$PHP_VERSION-cli \
                            php$PHP_VERSION-dev \
                            php$PHP_VERSION-common \
                            php$PHP_VERSION-json \
                            php$PHP_VERSION-intl \
                            php$PHP_VERSION-curl \
                            php$PHP_VERSION-mysql \
                            #php$PHP_VERSION-mcrypt \ **Conflict with PHP 7.2**
                            php$PHP_VERSION-gd \
                            php$PHP_VERSION-imagick \
                            php$PHP_VERSION-ldap \
                            php$PHP_VERSION-soap\
                            php$PHP_VERSION-zip \
                            php$PHP_VERSION-mbstring \
                            php$PHP_VERSION-bcmath \
                            php$PHP_VERSION-xml \
                            php$PHP_VERSION-imap \
                            php$PHP_VERSION-bz2 \
                            php$PHP_VERSION-memcache

# Install XDebug
RUN apt-get install php-xdebug
                            
# Install NodeJS and NPM
RUN apt-get install -y nodejs npm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Install Drush
RUN composer global require drush/drush:8.x
RUN mv /root/.composer/ /var/www/.composer
ENV PATH="$PATH:/var/www/.composer/vendor/bin"

# Install Drupal Console
RUN curl https://drupalconsole.com/installer -L -o drupal.phar \
&& mv drupal.phar /usr/local/bin/drupal \
&& chmod +x /usr/local/bin/drupal

# Install PHPMyAdmin
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y phpmyadmin

# Env Apache variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

# Copy files to www service
COPY config/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY config/php.ini /etc/php/$PHP_VERSION/apache2/php.ini
COPY config/xdebug.ini /etc/php/$PHP_VERSION/apache2/conf.d/20-xdebug.ini
COPY config/config-db.php /etc/phpmyadmin/config-db.php
COPY config/apache2.conf /etc/apache2/apache2.conf

# Enable Apache modules and restart
RUN a2enmod rewrite headers
RUN service apache2 start

# Chang uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Change permissions
RUN chown www-data:www-data -R /var/www
RUN chmod -R 755 /var/www

# Default working directory
WORKDIR /var/www/html