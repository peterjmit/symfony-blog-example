execute "install_composer" do
  command "curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer"
  creates "/usr/local/bin/composer"
end
