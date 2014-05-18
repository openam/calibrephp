Vagrant.configure("2") do |config|
  config.vm.box = "lorenzo/php-baking"
  config.vm.provision :shell, :path => "VagrantSetup.sh"
  config.vm.network :forwarded_port, host: 5000, guest: 80
  config.vm.network "private_network", type: "dhcp"
end
