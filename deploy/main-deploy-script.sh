#!/usr/bin/env bash

sudo -s

## 1) System Update
sudo apt update && sudo apt-get update

## 2) Install NodeJS & NPM
curl -sL https://deb.nodesource.com/setup_7.x | sudo -E bash -
sudo apt-get install -y nodejs
sudo apt-get install -y build-essential

## Install NGiNX
sudo apt-get install nginx

## 3) Install Git
sudo apt-get install git

## 4) Clone Project from Git
git clone https://acafc9ff96844719e61c1dce25815815ec6a1ed5:x-oauth-basic@github.com/egantz/kim-heyman.git /var/www/html/kimheyman.com --branch develop

## 8) Setup .env file
cp -Rf /var/www/html/kimheyman.com/deploy/.env /var/www/html/kimheyman.com/

## 9) Change system limits (sim. open files)
sudo cp -Rf /var/www/html/kimheyman.com/deploy/limits.conf /etc/security/limits.conf
sudo chown -R root:root /etc/security/limits.conf

## 10) Change system ctl conf
sudo cp -Rf /var/www/html/kimheyman.com/deploy/sysctl.conf /etc/sysctl.conf
sudo chown -R root:root /etc/sysctl.conf
sudo sysctl -p

## 11) Configure NGiNX
sudo cp -Rf /var/www/html/kimheyman.com/deploy/nginx.conf /etc/nginx/nginx.conf
sudo chown -R root:root /etc/nginx/nginx.conf
sudo cp -Rf /var/www/html/kimheyman.com/deploy/kimheyman.nginx /etc/nginx/sites-available/kimheyman
sudo chown -R root:root /etc/nginx/sites-available/kimheyman
sudo ln -s /etc/nginx/sites-available/kimheyman /etc/nginx/sites-enabled/kimheyman
sudo rm -rf /etc/nginx/sites-enabled/default
sudo nginx -t
sudo service nginx restart

## 13) Install PHP
sudo apt-get install php php7.0-dev php-fpm php7.0-mbstring php-apcu php-cgi php-cli php-common php-curl php-gd php-gmp php-json php-mail php-mysql php-memcache php-memcached
php-opcache php-xml php-xmlrpc php-bz2 php-imap php-mcrypt php-soap php-xsl uw-mailutils libgd-tools zip unzip php7.0-zip php-zip

## 14) Configure PHP-FPM
sudo cp -Rf /var/www/html/kimheyman.com/deploy/www.conf /etc/php/7.0/fpm/pool.d/www.conf
sudo service php7.0-fpm restart
sudo chown -R ubuntu:ubuntu /run/php
sudo service nginx restart

## 16) Install Redis
git clone https://github.com/phpredis/phpredis.git /home/ubuntu/phpredis
cd /home/ubuntu/phpredis
git checkout php7
phpize
./configure
sudo make && sudo make install
sudo rm -rf /home/ubuntu/phpredis
echo "extension=redis.so" > /etc/php/7.0/mods-available/redis.ini
sudo ln -sf /etc/php/7.0/mods-available/redis.ini /etc/php/7.0/fpm/conf.d/20-redis.ini
sudo ln -sf /etc/php/7.0/mods-available/redis.ini /etc/php/7.0/cli/conf.d/20-redis.ini
sudo service php7.0-fpm restart
sudo chown -R ubuntu:ubuntu /run/php
sudo service nginx restart

## 5) Install Composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

## 6) Install Application's dependencies
sudo chown -R ubuntu:ubuntu /var/www/html/kimheyman.com
cd /var/www/html/kimheyman.com ; composer install
cd /var/www/html/kimheyman.com/web/app/themes/kim-theme/ ; composer install
chown -R ubuntu:ubuntu /var/www/html/kimheyman.com

## 7) Install Yarn
sudo npm i -g yarn
yarn

## 17) Compile WordPress Theme
yarn run build:production
sudo chown -R ubuntu:ubuntu /var/www/html/kimheyman.com

## Install WP-CLI
cd /var/www/html/kimheyman.com
chmod +x /var/www/html/kimheyman.com/wp-cli.phar
sudo cp -Rf /var/www/html/kimheyman.com/wp-cli.phar /usr/local/bin/wp

## Enable Redis Plugin
wp plugin activate redis-cache
wp redis enable

## 18) Success!
