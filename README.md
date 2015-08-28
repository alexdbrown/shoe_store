# OMG Shoes!

##### Program listing shoe stores and brands of shoes local stores carry using MySQL, 08/28/15

#### By Alexandra Brown

## Description

This application allows a user to look up local shoes stores to find brands of shoes sold at that store.

## Setup
* Clone this repository

* Run the following command in the project directory
```console
$ composer install
```

* Import sql.zip files to PHPMyAdmin or follow along with the command line steps below:
```console
>CREATE DATABASE shoe_store;
>USE shoes;
>CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255), location VARCHAR (255), phone VARCHAR (255));
>CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));
>CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id bigint(20)UNSIGNED, brand_id bigint(20)UNSIGNED);
-in PHPMyAdmin copy the shoes database and create a shoes_test database
```

* Start Apache server with the following command:
```console
$ apachectl start
```

* Start a PHP server in the web directory
```console
$ php -S localhost:8000
```

* Navigate your browser to localhost:8000

* Enjoy!

## Technologies Used

PHP, PHPUnit, MySQL, Silex, Twig, HTML, CSS, Bootstrap

### Legal

Copyright (c) 2015 Alexandra Brown

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
