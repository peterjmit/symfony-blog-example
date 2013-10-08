node.set[:authorization][:sudo][:users] = ['ubuntu', 'vagrant']
node.set[:authorization][:sudo][:passwordless] = true
node.set[:authorization][:sudo][:sudoers_defaults] = [
  '!lecture,tty_tickets,!fqdn',
  'env_reset',
  'secure_path="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"'
]

include_recipe 'users::sysadmins'
include_recipe 'sudo'
include_recipe 'apt'
include_recipe 'git'
include_recipe 'build-essential'
include_recipe 'vim'
include_recipe 'dotdeb'
