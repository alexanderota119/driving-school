# Ed Driving

This is a software for ed Driving. Each tenant/ account will be able to manage all their stuff instructors, students, reports, logo, some colors, and other basic stuff.

## Project Stuff 1

-   [Contributing](docs/CONTRIBUTING.md)
-   [Turbo Repo](docs/TURBOREPO.md)

## Useful Links

-   [theme](https://demos.creative-tim.com/material-dashboard/pages/dashboard)
-   [Laravel](https://laravel.com/docs/9.x)
-   [inertia](https://inertiajs.com/)
-   [Typescript](https://www.typescriptlang.org/docs/)

## Once the servers are running at the end of this file, some notes

### Central Domain

The central domain has the ability to see ALL data regardless of the tenant_id column value.

### Tenants

Think of different tenants as different applications, all their data is automatically scoped buy the tenant_id column. Tenants are the subdomains by default you have bar.eddriving.local

tenants are scoped by the `domains` table foreign key to the tenants table.

## Start Development

### Clone repo

```shell
git clone git@github.com:Turtlebytes-LLC/driving-school.git
```

### Create .env file

```shell
cp apps/application/env{.example,} -v
```

### Set database credentials and other settings in the .env file

```shell
vim apps/application/.env
```

### Install dependencies

```shell
cd apps/application;
yarn install;
```

Ether

```shell
composer install
```

-- OR --

```shell
php composer.phar install
```

### Setup database

```shell
mysql -uUSER -p -e"create database driving_school";
cd apps/application;
php artisan migrate --seed
```

I created a post install hook in package.json to run composer install automatically

If that does not run `composer install` in the apps/application directory

### Add the /etc/hosts file entries

sudo vim /etc/hosts

Append this to the end of the file

```shell
127.0.0.1 bar.eddriving.local eddriving.local
```

### Start app option 1

In the root of the project run `yarn dev` or `yarn dev:log` that package.json script will use PM2 to run the laravel server, queue, and vite commands as a daemon

To stop pm2 you can run `yarn dev:stop` that runs `pm2 delete ecosystem.js` to remove the daemons from the background.

### Start app option 2

terminal 1

```shell
php artisan serve --host="0.0.0.0" --port="8000"
```

terminal 2

```shell
yarn watch
```

### BUGS

-   The vite HMR(hot module reloading) is not working same as browser sync. Something is conflicting.

### Login

the `yarn watch` command should show a url to open the site

watched url

## URLS

-   [Watched URL]('http://localhost:3000')
-   [Non watched url](http://eddriving.local:8000)
-   [Prettier Docs](https://prettier.io/docs/en/options.html)
-   [Google and iCal Links](https://github.com/spatie/calendar-links)
