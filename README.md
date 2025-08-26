## Tasks CRUD Aplication (Laravel + Vue + Inertia + ReorderableJS)
************
This is a simple CRUD application built with Laravel 11, using Inertia.js and Vue 3. 
Has the ability to reorder the tasks via Drag and Drop with ReorderableJS.

Requirements

- PHP 8.2 or Higher
- Composer
- Node.js and NPM
- Creates automatically a SQLite Database, but it can be used with MySQL, just config in .env file.
- 

## Installation

- Clone the repository: git clone https://github.com/clarkddr/tasks <name to your app>
- Change directory: cd <app_name>
- Install PHP Dependencies: composer install
- Install NPM Dependencies: npm install
- Copy env file: cp .env.example .env
- Generate App Key: php artisan key:generate
- Run database Migrations: php artisan migrate
- Run the Server: php artisan serve (I use Herd). This will give you an address. 
- Run NPM in another Terminal window: npm run dev

Just go to the address and you will see the application.

I could not add the bonus feature due to time limitations.  

## Author
David Ruiz - [clarkddr](https://github.com/clarkddr)
