# e-Pilketos menggunakan Laravel Svelte dengan Inertia
Aplikasi ini hanya sekedar proof of concept untuk [Laravel Svelte with Inertia boilerplate](https://github.com/dansvel/laravel-svelte) dari salah satu repoku.

e-Pilketos, adalah aplikasi pemungutan suara (voting) untuk Pemilihan Ketua OSIS.

## P E R I N G A T A N
Aplikasi ini memiliki **sangat banyak sekali** kekurangan, karena memang hanya sekedar eksperimen.

## Screenshot
![Login, using token. With validation and error message.](https://raw.githubusercontent.com/dansvel/epilketos-laravel-svelte-0.0/master/__screenshoot/screenshot1.jpg)

![Voting page.](https://raw.githubusercontent.com/dansvel/epilketos-laravel-svelte-0.0/master/__screenshoot/screenshot2.jpg)

![View detail and choose a candidate.](https://raw.githubusercontent.com/dansvel/epilketos-laravel-svelte-0.0/master/__screenshoot/screenshot3.jpg)

![Live count.](https://raw.githubusercontent.com/dansvel/epilketos-laravel-svelte-0.0/master/__screenshoot/screenshot4.jpg)

## Installation

Clone the repo
```shell script
git clone https://github.com/dansvel/laravel-svelte.git
cd laravel-svelte
```

Install PHP dependencies:
```shell script
composer install
```

Install NPM dependencies: you can use `npm` or `yarn`. I don't know why I can't use `pnpm`
```shell script
npm install
```

Build assets, or run it in watch mode
```shell script
npm run dev
npm run watch // so you can edit svelte files and refresh the webapp
```

Setup configuration:
```shell script
cp .env.example .env
```

Generate application key:
```shell script
php artisan key:generate
```

Setting your database then run migration and seeder
```
php artisan migrate
php artisan db:seed
```
seeding akan membuat 3 kandidat untuk dipilih dan 200 token untuk login pemilih

Run artisan server:
```shell script
php artisan serve
```
