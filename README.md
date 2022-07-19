## About The project

The app is a todo list build with <a href="https://laravel.com">Laravel Framework</a> + Laravel Breeze + <a href="https://vuejs.org">VueJS 3</a> Composition API.

Tasks are organized by categories and by logged in user.
You can create, modify, delete each category and tasks. And finally you can check a task if it is finished.

## Installation

First clone the projet :

git clone git@github.com:riveur/laravel-todo.git

Install dependencies :

composer install
npm install

Migrate the tables :

php artisan migrate:fresh --seed

Run app :

npm run dev
