# Slim CRUD Template

This Slim CRUD Template is a fork of the [slim/slim-skeleton](https://github.com/slimphp/Slim-Skeleton) application ~~on~~ ~~steroids~~.

⚠ Disclaimer: This application only supports PHP<=5.5 ⚠

Check out the `routes.php` for a basic RESTful architecture pattern example to kickstart your API development.

This application utilizes the Eloquent ORM for basic CRUD operations and PSR-4 autoloading standard for the autoloading classes inside the `classes` folder.

>Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

>This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

 You need [Git](https://git-scm.com/downloads) and [Composer](https://getcomposer.org) to install this application.

 A Vagrantfile is also included using Scotchbox as a preconfigured Vagrant Box. Click the links for more information about [Vagrant](https://git-scm.com/downloads) and [Scotchbox](https://github.com/scotch-io/scotch-box). I have also made a [copy-paste cheat-sheet](https://gist.github.com/jjjjcccjjf/5fd9f696c36f23d72d3ae7b4eb9965d6) for setting easily setting up Scotchbox.

Clone or download this repository.

    $ git clone https://github.com/jjjjcccjjf/slim-crud.git

If you have [Vagrant](https://git-scm.com/downloads) installed `cd` to the project directory and run `vagrant up`

    $ cd my-project
    $ vagrant up

Assuming composer is globally installed, run `composer install` in your project directory

    $ composer install

If you don't have Vagrant installed and are using one of the \*AMPP variants, your base URL will probably be

    http://localhost/slim-crud-master/public

I haven't had a workaround for this, but I will try to make one in the future.

---

## Dev roadmap 🛰

* unit tests 👈 up next!
* ~~upload~~
* firebase template 👈 up next!
* authentication
  * oAuth
  * basic
  * digest
* localhost bug workaround (XAMPP)
* ~~status codes~~
* ~~sanitize all inputs~~
* ~~add validation for uploads~~
* migrations
* ~~set header location of newly added record~~
* tag builds 👈 up next!

Feel free to contribute!

---
Just tweet me if you need help `@jjjjcccjjf`. ☺
