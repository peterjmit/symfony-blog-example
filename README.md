# Symfony 2 blog app

[![Build Status](https://travis-ci.org/peterjmit/symfony-blog-example.png?branch=master)](https://travis-ci.org/peterjmit/symfony-blog-example)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/fe313a72-b86d-4b71-9c51-3212e90fdee0/mini.png)](https://insight.sensiolabs.com/projects/fe313a72-b86d-4b71-9c51-3212e90fdee0)

## Getting up and running

### Dev environment
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
```

### Asset management
There is one front-end dependency, twitter bootstrap and it is pulled in with
the [bower package manager](https://github.com/bower/bower). Bower & bootstrap

```
$ npm install -g bower
$ cd <path-to-repository-root>/web
$ bower install
```

### Prime the app
```
$ composer install
$ php app/console doctrine:database:create
$ php app/console doctrine:migrations:migrate
$ php app/console cache:clear --env="prod"
$ php app/console assets:install
$ php app/console assetic:dump --env="prod"
```

### Run the test scripts

```bash
$ app/console doctrine:database:create --env="test"
$ app/console doctrine:migrations:migrate --env="test"
$ bin/behat
$ bin/phpspec run
```

Or just use the app <http://33.33.33.10> (if using vagrant)

Lastly you can configure the blog title and name:

```yaml
peterjmit_blog:
    name: Pete's blog
    title: Welcome to Pete's blog!
    posts_per_page: 20 # defaults to 5
```

## Note
If you aren't running this in an environment with redis then you will need
to change the following lines (9-13) - either change them to a driver you do have
(i.e. apc) or comment them out.

```yaml
doctrine:
   orm:
       metadata_cache_driver: redis
       result_cache_driver: redis
       query_cache_driver: redis
```
