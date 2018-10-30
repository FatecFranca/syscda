#!/usr/bin/env bash

echo 'adding swap file'
fallocate -l 1G /swapfile
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile
echo '/swapfile none swap defaults 0 0' >> /etc/fstab

echo 'updating system'
sudo apt-get update
sudo apt-get upgrade -y

echo 'install development environment'
# apache
sudo apt-get install -y apache2
# php
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get install software-properties-common
sudo apt-get update
sudo apt-get install -y php7.2
sudo apt-get install -y php7.2-common
sudo apt-get install -y php7.2-cli
sudo apt-get install -y php7.2-readline
sudo apt-get install -y php7.2-mbstring
sudo apt-get install -y php7.2-mcrypt
sudo apt-get install -y php7.2-mysql
sudo apt-get install -y php7.2-xml
sudo apt-get install -y php7.2-zip
sudo apt-get install -y php7.2-json
sudo apt-get install -y php7.2-curl
sudo apt-get install -y php7.2-gd
sudo apt-get install -y php7.2-gmp
sudo apt-get install -y libapache2-mod-php7.2
sudo apt-get install -y php7.2-mongodb
sudo a2enmod rewrite
sudo service apache2 restart
# composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer

# nodejs
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
sudo apt-get install -y nodejs
# gulp
sudo npm install gulp-cli -g
sudo npm install eslint -g

# mysql
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
sudo apt install -y mysql-server
sudo apt install -y mysql-client
sudo apt install -y libmysqlclient-dev

# mongodb
sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 9DA31620334BD75D9DCB49F368818C72E52529D4
echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu xenial/mongodb-org/4.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-4.0.list
sudo apt-get update
sudo apt-get install -y mongodb-org
sudo systemctl enable mongod

# Set PT-BR
sudo apt-get install language-pack-pt
sudo locale-gen pt_BR.UTF-8

# Set Vhost
sudo echo -e "<VirtualHost *:80>
    ServerName local.syscda
    DocumentRoot /vagrant/public
    <Directory /vagrant/public>
        AllowOverride all
        Options Indexes FollowSymLinks
        require all granted
    </Directory>
    ErrorLog /vagrant/apache2_syscda.log
</VirtualHost>" >> /etc/apache2/sites-available/syscda.conf
sudo a2ensite syscda.conf
sudo service apache2 restart

echo 'done, all set'
