# Bem vindo(a) ao CDA!

Para ter um ambiente de desenvolvimento requer os seguintes programas para Windows

- PHP 7.2 => Sugiro usar o XAMPP

- Composer => Ferramente de linnha de comando

- Laravel => Precisa do composer

- MySql

- Node

Em demais sistemas operacionais vai precisar dessas ferramentas bases,
seja eles varias distros do Linux ou MacOS, na coloquei aqui porque n�o
sei configurar corretamente. Mas sinta-se a vontade para contribuir.  :)


### Para instalar clone o projeto em seu ambiente de desenvolvimento.

Rode os comandos de npm install e composer install.

Gere e configure o .env a partir do .env.example.

No .env coloque as informações do banco de dados.

Gere a key do Laravel através do comando php artisan key:generate

Rode as migrations e as seeds

php artisan migrate

php artisan db:seed

Execute npm run dev.

## Como usar o Vagrant

1. `vagrant up`
2. `cp .env.example .env`
3. `vagrant ssh`
4. `cd /vagrant`
5. `composer install && npm install`
6. `php artisan key:generate`
7. `sudo vim /etc/mongod.conf`
8. Change `bind_id` from `127.0.0.1` to `0.0.0.0`
9. `sudo vim /etc/mysql/mysql.conf.d/mysqld.cnf`
10. Change `bind-address` from `127.0.0.1` to `0.0.0.0`
11. `mysql -u root -p`
12. Type mysql password
13. `grant all on *.* to 'root'@'%' identified by 'root';`
14. `flush privileges;`
15. `create database dodb;`
16. `exit;`
17. `sudo service mysql restart`
18. `php artisan migrate && php artisan db:seed`