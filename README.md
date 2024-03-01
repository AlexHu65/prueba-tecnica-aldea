
# Prueba tecnica Aldea

## Tecnología

El presente proyecto se encuentra desarrollado con el siguiente STACK:

| Tech | README |
| ------ | ------ |
| PHP 8.2 | https://www.php.net/releases/8.2/en.php|
| Composer | https://getcomposer.org|
| Node.js 20.4.0 | https://nodejs.org|
| Laravel 10.19.0 | https://laravel.com|
| Optional Docker compose v2.19.1 | https://docs.docker.com/compose|
| Optional: Docker desktop | https://www.docker.com/products/docker-desktop|
| Optional: Docker desktop | https://www.docker.com/products/docker-desktop|
| Optional Windows Installation: Docker wsl | https://docs.docker.com/desktop/wsl|


## Configurations and environment

On laravel is needed an ***.env*** file to setting internal configurations, you can use the .env.example to generate your environment file.  

There are 2 importants settings for your app:  

**Database:** Please be sure that you are setting correctly like these:

```sh
DB_CONNECTION=mysql
DB_HOST=db-aldea
DB_PORT=3306
DB_DATABASE=aldea_db
DB_USERNAME=root
DB_PASSWORD=s1st3m2s
```  

Is your decision to use the above values, these are only examples. But ensure you that are config this because these values are importants to access to your database once the installations is finished.  

## Installation

There's 2 ways to install and start to develop this template:

- Install docker desktop on dev's PC
- Install all environment and dependencies (PHP, MySQL, Appache/Nginx, Node.js)

Definitely the second way can be tedious and long time installation, anyways, you (the dev), decides which one is your best choice: May the Force be with you!.

- NOTE: If you decided for the first option you need to verify hardware's requirements on docker desktop docs.


## Docker and containers

```sh
cd ~/{app-dir}
```

Now, assumme that you installed Docker desktop and all their dependencies it's time to build your first Container. Please be sure that your terminal is located on the root directory of your app your Scaffolding looks like this  


```sh
-- app-dir  
    
        -- app/  
        
        -- docker/  

            -- nginx/  

                -- app.conf  

            -- node/  

                -- node_start.sh  

        -- .dockerignore  
        -- docker-compose.yml
        -- Dockerfile  
```

Then you need to run this command to build your containers:  

```sh
docker-compose up
```

Once you run the command describe above and in your terminal outputs are OK, you can check which containers are runing and building with this command:


```sh
docker-compose ps
```  

There are some impotant commands to prepare your environment:  

1. Run migrations 

```sh
docker-compose exec app-aldea php artisan migrate
```  

2. Run seeders:  

```sh
docker-compose exec app-aldea php artisan db:seed
```  

3. Install node dependencies:  

```sh
docker-compose exec node-aldea npm i
```  

4. Run npm watch to generate laravel mix assets:  

```sh
docker-compose exec node-aldea npm run watch
```  

5. Config on .env queue worker

QUEUE_CONNECTION="database"

6. Config on .env email smtp

```sh
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=a82294226@gmail.com 
MAIL_PASSWORD=ckakwhbnmmkyvaar
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="${APP_NAME}"
```  
7. Config jwt token

```sh
docker-compose exec app-aldea php artisan jwt:secret
```  

8. Run queues

```sh
docker-compose exec app-aldea php artisan queue:work
```  


9. Run on 
http://localhost:8001/

# Local environments

Once you put this repository on local, please run these commands:

1. Run migrations 

```sh
php artisan migrate
```  

2. Run seeders 

```sh
php artisan db:seed
```  

3. Config jwt token

```sh
php artisan jwt:secret
```  

4. Run server

```sh
php artisan serve
```  

5. Config on .env queue worker

QUEUE_CONNECTION="database"

6. Config on .env email smtp

```sh
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=a82294226@gmail.com 
MAIL_PASSWORD=ckakwhbnmmkyvaar
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="${APP_NAME}"
```  

7. Install node dependencies:  

```sh
docker-compose exec node-aldea npm i
```  

8. Using npm to generate laravel mix assets
```sh
npm run watch
```  

9. Run queues

```sh
php artisan queue:work
```  

10. Run on 
http://localhost:8000/

