## About The project

The app is a todo list build with [Laravel Framework](https://laravel.com) + Laravel Breeze + [VueJS 3](https://vuejs.org) Composition API.

Tasks are organized by categories and by logged in user.
You can create, modify, delete each category and tasks. And finally you can check a task if it is finished.

![Preview of app](https://i.imgur.com/OE3Fjua.png)

## Installation

### First clone the projet :

```
git clone https://github.com/riveur/laravel-todo.git
```

### Install dependencies :

```
composer install
npm install
```

### Migrate the tables :

```
php artisan migrate:fresh --seed
```

### Run app :

```
npm run dev
```
