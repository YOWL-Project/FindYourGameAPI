# FindYourGame

Developing a solution from client needs.  
Back using :

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Our Project

## Missions

FindYourGame is a web and mobile application that allows users to comment all the games found on the freetogame.com API. This tool must help decentralize social networking comments and have a new web vision through participatory sources or simply by adding a comment to federate communities around websites.

Each comment will be shared by the entire FindYourGame user community. Our tool will make it possible to decentralize comments from social networks and to have a new vision of the web through participatory on sources (OSINT) or simply by adding a comment thus federating communities around websites.

## Requirements

The client suggests some technical requirements that you can consider:  
• the API can be developed using the Laravel framework,  
• the front end can be developed in Vue.js,  
• a database could be an SQL one such as MariaDB or PostgreSQL,  
• there must be a secured authentication system.  
Your tasks are numerous and include:

1. the setting up of a full-featured GitHub repository allowing your client/teacher to test and give you
   regular feedback, and your team to publish frequent releases,
2. the development and versioning of a minimum viable product, a working implementation of the main
   features and the design.

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/YOWL-Project/FindYourGameAPI.git

Switch to the repo folder

    cd FindYourGameAPI

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Install passport client

    php artisan passport:install

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/YOWL-Project/FindYourGameAPI.git
    cd FindYourGameAPI
    composer install
    cp .env.example .env
    php artisan key:generate

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan passport:install
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DatabaseSeeder and set the property values as per your requirement

    database/seeders/DatabaseSeeder.php

Run the database seeder and you're done

    php artisan db:seed

**_Note_** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

**Make sure to set a nex passport client after refreshing your database** [Passport grant client](https://laravel.com/docs/8.x/passport#creating-a-password-grant-client)

If you haven't yet or the easy method:

    php artisan passport:install

All passport methods needed:

    php artisan passport:keys
    php artisan passport:client
    php artisan passport:client --password

# Code overview

## Folders

-   `app` - Contains all the Eloquent models
-   `app/Http/Controllers` - Contains all the controllers
-   `app/Http/Middleware` - Contains the auth middleware
-   `config` - Contains all the application configuration files
-   `database/factories` - Contains the model factory the models concerned
-   `database/migrations` - Contains all the database migrations
-   `database/seeders` - Contains the database seeder
-   `routes` - Contains all the api routes defined in api.php file

## Environment variables

-   `.env` - Environment variables can be set in this file

**_Note_** : You can quickly set the database information and other variables in this file and have the application fully working.

---

The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

## API Specification

This application adheres to the api specifications set by the [Thinkster](https://github.com/gothinkster) team. This helps mix and match any backend with any other frontend without conflicts.

    [Full API Spec](https://github.com/gothinkster/realworld/tree/master/api)

More information regarding the project can be found here https://github.com/gothinkster/realworld

---

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api

Request headers

| _Required_ | _Key_            | _Value_          |
| ---------- | ---------------- | ---------------- |
| Yes        | Content-Type     | application/json |
| Yes        | X-Requested-With | XMLHttpRequest   |
| Optional   | Authorization    | Bearer {JWT}     |

Refer the [api specification](#api-specification) for more info.

---

# Authentication

This applications uses Passport Token (JWT) to handle authentication. The token is passed with each request using the Authorization header with Token scheme. The Passport authentication middleware handles the validation and authentication of the token. Please check the following sources to learn more about Passport.

-   https://laravel.com/docs/8.x/passport

---

# Cross-Origin Resource Sharing (CORS)

This applications has CORS enabled by default on all API endpoints. The default configuration allows requests from http://localhost:3000 and http://localhost:4200 to help speed up your frontend testing. The CORS allowed origins can be changed by setting them in the config file. Please check the following sources to learn more about CORS.

-   https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
-   https://en.wikipedia.org/wiki/Cross-origin_resource_sharing
-   https://www.w3.org/TR/cors
