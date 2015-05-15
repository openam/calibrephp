Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.provision :shell, :path => "VagrantSetup.sh"
  config.vm.network :forwarded_port, host: 5000, guest: 80
  config.vm.network "private_network", type: "dhcp"
  config.vm.synced_folder "./", "/var/www/html", id: "vagrant-root",
    owner: "vagrant",
    group: "www-data",
    mount_options: ["dmode=775,fmode=664"]
end
