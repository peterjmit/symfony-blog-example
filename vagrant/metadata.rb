name             'apple-blog'
maintainer       'Peter Mitchell'
maintainer_email 'pete@peterjmit.com'
license          'MIT'
description      'Recipes for installing a Symfony 2 blog application on Debian Wheezy with Dotdeb'
version          '0.1.1'

supports 'debian'

# base reqs
depends 'users'
depends 'sudo'
depends 'apt'
depends 'git'
depends 'build-essential'
depends 'vim'
depends 'dotdeb'

# Application server
depends 'nginx'
depends 'php'
depends 'php-fpm', '>= 0.1.2'

# Database server
depends 'mysql'
