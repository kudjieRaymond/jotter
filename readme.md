# JOTTER
Task Mannagenemt SPA made with Laravel and VueJS. Features CRUD functionality,
Authentication by JWT, vue router, vuex, 


## Getting Started

Download or clone a copy of this repository on your local machine.

### Prerequisites

Install the Vue CLI.
https://cli.vuejs.org/guide/installation.html

Laravel Requirements. https://laravel.com/docs/5.8#installing-laravel

### Installing

Create a MySQL database

```
mysql> CREATE DATABASE laratasks;
```

Go to the project directory
```
cd laravel-vue-todo
```

Run composer install
```
composer install
```

Rename .env.example to .env
```
mv .env.example .env
```

Replace these values in .env
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=laratasks
DB_USERNAME=*************
DB_PASSWORD=*************
```

Generate an application key
```
php artisan key:generate
```

Generate a JWT key
```
php artisan jwt:secret
```

Run migrations
```
php artisan migrate
```

Go to the Vue CLI project
```
cd vue-task
```

Run npm install
```
npm install
```

Run the server
```
npm run dev
```
Start your laravel development Server by running
```
 php artisan serve 
```
**Note:** Make sure your laravel server run on port 8000 as speicified in vue-task/src/common/config.js or you will get a CORS error.

That's it!

In your browser navigate to this address to start the application
```
http://localhost:8080/register 
```


## Built With

* [Laravel](https://laravel.com/) - PHP framework
* [Vue.js](https://vuejs.org/) - Javascript framework
* View package.json and composer.json for a complete list of packages used.


## License

This project is licensed under the MIT License