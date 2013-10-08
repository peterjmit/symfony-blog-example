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
$ php app/console cache:clear --env="prod"
$ php app/console assets:install
$ php app/console assetic:dump --env="prod"
```

You can run the test scripts

```bash
$ app/console doctrine:database:create --env="test"
$ app/console doctrine:migrations:migrate --env="test"
$ bin/behat
$ bin/phpspec run
```

Or just use the app <http://33.33.33.10>

I would usually HTML5 validation on, but I have turned it off to show the Symfony
validation framework in action.

Lastly you can configure the blog title and name:

```yaml
peterjmit_blog:
    name: Pete's blog
    title: Welcome to Pete's blog!
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
