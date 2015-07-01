# laravel-angular-es-todo
Simple todo app with laravel, angular and elasticsearch

# Server Setup
For the sake of simplicity, http://puphpet.com/ will be used to create the virtual machine

- Create a directory `vagrant` and paste the contents of `puphpet.zip`. Directory structure should be like
  - vagrant
    - puphpet (dir)
    - Vagrantfile
- From your terminal visit the vagrant directory and `vagrant up`
- The server will be created with all the necessary services to run the app
- Edit your local hosts file `sudo pico /etc/hosts` and add the following line
  - `192.168.56.111  todo.local`
- Once the server is up, login with `vagrant ssh`
  - `cd /var/www/todo.local/ `
  - `composer install`

# Laravel .env
- Once the server is up, login with `vagrant ssh`
  - `cd /var/www/todo.local/`
  - `cp .env.example .env`
  - Edit the `.env` file and set the database settings (db name/user/pass)

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