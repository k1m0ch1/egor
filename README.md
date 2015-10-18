## EGOR - Electronic Integration Operation Resource

### Goal
To create an integration portal that can combine and deliver all different kind of web application / program from a client based on url.

### Production Environtment
1. Nginx / Apache
1. PHP 5.6
1. PHP-mbstring for encryption
1. Mod Rewrite for Apache must active

### Developer Installation

1. Install [Composer](https://getcomposer.org/)
1. Git Clone this package
1. Go to the packaged folder

1. Copy .env.example to .env
1. Fill .env with the correct configuration
1. Run 
```` shell
composer install
bower install
chmod 777 -Rf storage/
php artisan migrate
php artisan db:seed
````

### Reference
1. bppt.bandung.go.id << version 1
2. portal.dimassrio.me - portal.dimassrio.me/dashboard
````
username : admin@ordent.co
password : admin1234
````