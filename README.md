# Symfony 2 blog app

## Getting up and running

I have supplied a Vagrant file for setting up a dev environment
on a debian wheezy virtualbox. It requires the the Berkshelf gem
and vagrant-berkshelf plugin to be installed (as well as vagrant
of course).

```bash
$ gem install berkshelf
$ vagrant plugin install vagrant-berkshelf
$ cd vagrant/ && vagrant up
```

This will install:
* Mysql
* php 5.5
* redis
* nginx
* composer (available globally `$ composer`)

You can ssh into the box and set up the app, for MySQL you can use the user root
and password "rootpass" (configured in the Vagrantfile)

```bash
$ cd vagrant/ && vagrant ssh
$ cd /var/www/blog
$ composer install
$ php app/console doctrine:database:create
$ php app/console doctrine:migrations:migrate
```

You can run the test scripts

```bash
$ bin/behat
$ bin/phpspec run
```

Or use the app <33.33.33.10>
