# Docker template for Drupal 8 projects

## Content

* MySQL/MariaDB
* PHP 5.6,7.0,7.1,7.2,7.3
* Apache 2.4
* PhpMyAdmin
* Mailhog
* XDebug
* Drush
* Drupal Console

## How to

### Up environment

Clone git repo.

```sh
git clone https://github.com/managume/docker-xdebug.git
cd docker-xdebug
```
Copy dist.env to .env and edit if it's neccesary.

```sh
cp dist.env .env
```
(Optional) For better experience you can execute following commands to deploy custom scripts for interact with docker services

```sh
sh .docker/bin/docker-symlinks-up
```

Now, up Docker.

```sh

# Using custom scripts
sh dup

# Using docker-compose
docker-compose up -d --build --no-recreate
```

### Down Environment

```sh

# Using custom scripts
sh ddown

# Using docker-compose
docker-compose down
```

### Config XDebug for VSCode

Install [PHP Debug](https://github.com/felixfbecker/vscode-php-debug) extension and edit PHP Debug ```launch.json```.

```json
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Docker Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9000,
            "pathMappings":{
                "/var/www/html":"${workspaceRoot}"
            },
        }
    ]
}
```

## Custom Docker Scripts

After exec ```sh .docker/bin/docker-symlinks-up``` following commands are available:

* ```sh dup``` Up and run docker in background
* ```sh ddown``` Down docker
* ```sh dreset``` Reset docker
* ```sh dexec``` Execute with www-data user
* ```sh droot``` Execute with root user
* ```sh dcomposer``` Composer
* ```sh ddrush``` Drush
* ```sh dconsole``` Drupal console
* ```sh dnpm``` Npm         
