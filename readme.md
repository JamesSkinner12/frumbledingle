## Setup Instructions
- REQUIRED: `php`, `git`, `composer`, `mysql`, `node`, `npm`
- `git clone` this repo
- Run `cp .env.example .env` to copy the example environment file to the version used by the application.
- Run `composer install`
- Make sure to set the database information your `.env` file
- Run `php artisan migrate`
- Run `npm install` to install javascript dependencies
- Host the app however you'd prefer, but use `npm run dev` or `npm run watch` to compile the Vue components
- Run `php artisan key:generate` to generate the app key
