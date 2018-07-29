x# john

### Docker Installation
Install docker from https://docs.docker.com/install/

If you're on windows 7, you'll need Docker Toolbox https://docs.docker.com/toolbox/toolbox_install_windows/
Download the latest vagrant https://www.vagrantup.com/downloads.html
Download virtualbox http://www.oracle.com/technetwork/server-storage/virtualbox/downloads/index.html
this is all needed
before running docker, cd into the docker folder and run "vagrant up" then "vagrant ssh", this is so 

windows will mount / bind the proper directories as volumes for docker

---

### Environment setup

Make a subfolder in the docker folder called `private`  
Download http://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.1.jar into the private folder, it is too big to conveniently put into a repo  
Create a file called .env in the root of this project, it should look something like this:  
```
APP_NAME=john  
APP_ENV=local  
APP_KEY=base64:iLd/AwwoIzIIWLvAm0Lx9kX2LUD//XW7j9vmZhDE5ww=  
APP_DEBUG=true  
APP_URL=http://localhost.john.com  
LOG_CHANNEL=stack  
DB_CONNECTION=pgsql  
DB_HOST=john-postgres  
DB_DATABASE=john  
DB_USERNAME=john  
DB_PASSWORD=password  
BROADCAST_DRIVER=redis  
CACHE_DRIVER=redis  
SESSION_DRIVER=redis  
SESSION_LIFETIME=120  
QUEUE_DRIVER=sync  
REDIS_HOST=john-redis  
REDIS_PASSWORD=null  
REDIS_PORT=6379  
MAIL_DRIVER=log  
MAIL_HOST=smtp.mailgun.org  
MAIL_PORT=587  
MAIL_ENCRYPTION=null  
```
---

### Docker setup
If on windows 7, cd into the docker folder and run:  
`vagrant up`  
`vagrant ssh`  
This will start up a linux machine where docker will run, this linux machine will offer the needed file system sharing for the docker containers to operate.  

If on MacOS, docker needs file permissions to write to your drive and the easy way to accomplish this is to store your workspace in your user direction (e.g. /User/YOURNAME/john/workspace/)

---

### Containers with docker-compose
To have the containers begin their install scripts, cd to the docker folder and run:  
`docker-compose up -d`  
This will take a few minutes as the containers download images of linux and execute various scripts to install packages we need.  


---

### Connecting to the container
Now there will be various containers running on that docker-machine, to connect to the dev container run:  
`docker exec -it john-dev /bin/bash`  
Then cd into the workspace folder and run:  
`composer install`  

---

### Accessing the local website
The website should be accessible by the IP of the docker-machine, to find that IP you can run `docker-machine ip` from outside of the container (e.g. in your computers native OS). If you are running on MacOS you may be running the containers on localhost. 
If you're on windows 7 the IP is in the Vagrantfile as 192.168.33.40.

---

### Commonly used commands
`php artisan migrate`  
To initialize the database tables  
  
`php artisan migrate:reset`  
To roll back database tables  
  
`php artisan db:seed`  
Fill the database with mock data  
  
`vendor/bin/phpunit`  
To run unit tests  
  
`php artisan tinker`  
To run some terminal-like tool to have direct access to the web server to run commands such as `App\User::where('id', 1)->get()` or `App\Membership::where('type', 'bronze')->count()`

`tail -n 50 storage/logs/laravel.log`  
Access the recent error logs, increase n as needed
