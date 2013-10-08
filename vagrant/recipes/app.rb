include_recipe 'dotdeb::php55'

php_ini_options = {
  'date.timezone' => 'America/Montreal',
  'short_open_tag' => 'Off',
  'magic_quotes_gpc' => 'Off',
  'register_globals' => 'Off',
  'session.autostart' => 'Off',
  'expose_php' => 'Off',
  'allow_url_include' => 'Off',
  'cgi.fix_pathinfo' => 'Off'
}

# PHP config
node.set[:php][:directives] = php_ini_options
node.set[:php_fpm][:php_ini][:directives] = php_ini_options

include_recipe 'php'

packages = [
  'php5-mysql',
  'php5-gd',
  'php5-redis',
  'php5-curl',
  'php5-intl',
  'php5-sqlite'
]

packages.each do |pkg|
  package pkg do
    action :install
  end
end

include_recipe 'php-fpm'
include_recipe 'nginx'

template '/etc/nginx/sites-available/default' do
  source 'blog.vhost'
  owner 'root'
  group 'root'
  mode 0644
end

execute "reload_nginx" do
  command "service nginx reload"
  action :run
end
