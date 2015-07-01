# laravel-angular-es-todo
Simple todo app with laravel, angular and elasticsearch

# Screencast demo
https://www.dropbox.com/s/5o2sclsjr2mj5ql/screencast.mp4?dl=0

# Server Setup
For the sake of simplicity, http://puphpet.com/ will be used to create the virtual machine

- Download and install virtual box https://www.virtualbox.org/wiki/Downloads
- Download and install vagrant http://www.vagrantup.com/downloads.html
- Clone the repository locally using your favorite way/tools
- Enter your local repository
- Create a directory `vagrant` and paste the contents of `puphpet.zip`. Directory structure should be like
  - vagrant
    - puphpet (dir)
    - Vagrantfile
- From your terminal enter the vagrant directory you just created and `vagrant up`
- The server will be created with all the necessary services to run the app
- Edit your local hosts file `sudo pico /etc/hosts` and add the following line
  - `192.168.56.111  todo.local`
- Once the server is up, connect to the vm by running `vagrant ssh`
  - `cd /var/www/todo.local/ `
  - `cp .env.example .env`
  - Edit the `.env` file (`pico .env`) and set the database settings (db name/user/pass)
      - `DB_DATABASE=todo_db`
      - `DB_USERNAME=todo_user`
      - `DB_PASSWORD=123`
  - `composer install`
  - `php artisan migrate`
  - `php artisan key:generate`
  - Visit http://todo.local and enjoy :)


# Passwords
- Mysql `root@todo_db / 123`
- Mysql `todo_user@todo_db / 123`

# Paths
- Apache `/var/www/todo.local/`

# URLs
- App http://todo.local
- Mailcatcher http://192.168.56.111:1080
- Adminer http://192.168.56.111/adminer
- ElasticSearch http://192.168.56.111:9200/

# Further improvements
- Use bower for frontend dependencies
- Use elixir to minify/concat css and js
- Apply the repository pattern
- Implement caching

# Troubleshooting

In case you get the following error when `vagrant up`

```
==> default: Running 'pre-boot' VM customizations...
A customization command failed:

["modifyvm", :id, "--name", "local.puphpet"]

The following error was experienced:

#<Vagrant::Errors::VBoxManageError: There was an error while executing `VBoxManage`, a CLI used by Vagrant
for controlling VirtualBox. The command and stderr is shown below.

Command: ["modifyvm", "e3e55c76-047b-4e5b-9755-0a31f0c4b823", "--name", "local.puphpet"]

Stderr: VBoxManage: error: Could not rename the directory '/Volumes/HDD/ExtUsers/Ioanna/VirtualBox VMs/vagrant_default_1435774793994_96256' to '/Volumes/HDD/ExtUsers/Ioanna/VirtualBox VMs/local.puphpet' to save the settings file (VERR_ALREADY_EXISTS)
VBoxManage: error: Details: code NS_ERROR_FAILURE (0x80004005), component SessionMachine, interface IMachine, callee nsISupports
VBoxManage: error: Context: "SaveSettings()" at line 2788 of file VBoxManageModifyVM.cpp
>

Please fix this customization and try again.
```

Then do a `vagrant destroy` and delete any of the remaining directories (directories may vary according to your installation)
- /Volumes/HDD/ExtUsers/Ioanna/VirtualBox VMs/vagrant_default_1435774793994_96256'
- and /Volumes/HDD/ExtUsers/Ioanna/VirtualBox VMs/local.puphpet