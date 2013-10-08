service 'redis-server' do
  supports  [:start, :stop, :restart]
end

package 'redis-server' do
  action :install
end
