# VitsKaffee_CoffeeFinder

## IDE setup
- Install WP Cli
    ```
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
    chmod +x wp-cli.phar
    sudo mv wp-cli.phar /usr/local/bin/wp
    ```
- Install Wordpress reference for IDE autocompletes:
    ```
    wp core download --path=./wp-ref
    ```
  
- Install a local Php interpreter
- Install the wordpress plugin in PHPStorm: https://plugins.jetbrains.com/plugin/7434-wordpress
- Configure the Plugin: ![WP-setup](./docs/ide-setup.png) 

## Docker test setup

Please ensure your Docker installation has set any DNS server.

```shell script
docker-compose up
docker exec -ti wordpress /bin/bash /root/bootstrap-wp.sh
```

All logins are `wordpress:wordpress`

You will get your instance under https://localhost:8080 and should be able to configure it. 

In case of any errors (and if you have no other important docker container/images on your rig):
```shell script
docker kill $(docker ps -q)
docker system prune -a
docker volume rm $(docker volume ls -q)
```

Unfortunately this setup does not run with podman or podman-compose yet





  --url=<url>
    The address of the new site.

  --title=<site-title>
    The title of the new site.

  --admin_user=<username>
    The name of the admin user.

  [--admin_password=<password>]
    The password for the admin user. Defaults to randomly generated string.

  --admin_email=<email>
    The email address for the admin user.

  [--skip-email]
    Don't send an email notification to the new admin user.


wp --allow-root --path=/var/www/html core install --url=http://localhost  --title=vits-test --admin_user=wordpress --admin_password=wordpress --admin-email=somwhere@domain.tld --skip-email