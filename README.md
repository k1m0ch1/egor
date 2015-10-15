## EGOR - Electronic Integration Operation Resource

### Goal
To create an integration portal that can combine and deliver all different kind of web application / program from a client based on url.

### Development Environtment
1. Nginx / Apache
2. PHP 5.6
3. PHP-mbstring for encryption
4. Laravel Framework
5. SASS based styling (Gulp)

### Developer Installation

1. Install [Composer](https://getcomposer.org/)
2. Install NPM [Node Package Manager](https://www.npmjs.com/)
3. Install Bower : npm install -g bower
4. Git Clone this package
5. Go to the packaged folder

6. Copy .env.example to .env
7. Fill .env with the correct configuration
8. Run 
```` shell
composer install
bower install
npm install
chmod 777 -Rf storage/
php artisan migrate
````

### OR (ADVANCED DEVELOPER ONLY)
If you have a good machine (4GB RAM > More)
you can download a VM based development environtment with [Laravel / Homestead](http://laravel.com/docs/5.1/homestead)
Using Virtual Box + [Vagrant](https://www.vagrantup.com)
it contain all needed software, if configured properly, you only need to up the machine, deploy and then start code.

### Designer Guide

1. We are using Foundation CSS for Frontend
2. Bootstrap-sass + AdminLTE for Backend
3. You can check all of the styling at assets/sass
4. All of bower installed package goes to public/assets/vendor
5. You can do gulp servef after doing npm install
6. All your change can go to app.scss

### Reference
1. bppt.bandung.go.id << version 1
2. portal.dimassrio.me - portal.dimassrio.me/dashboard
````
username : tester@dimassrio.me
password : tester
````
Frontend
![alt text][frontend]
[frontend]: http://i.imgur.com/J0t0TCe.png "Frontend Image"


Backend
![alt text][backend]
[backend]: http://i.imgur.com/RS3DdwO.png "Backend Image"