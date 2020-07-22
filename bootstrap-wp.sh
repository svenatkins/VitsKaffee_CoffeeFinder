#!/bin/bash
apt-get update
apt-get install less
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
mv wp-cli.phar /usr/local/bin/wp
wp --allow-root --path=/var/www/html core install --url=http://localhost:8080  --title=vits-test --admin_user=wordpress --admin_password=wordpress --admin_email=somwhere@domain.tld --skip-email
wp --allow-root --path=/var/www/html plugin install woocommerce
wp --allow-root --path=/var/www/html  plugin activate woocommerce
wp --allow-root --path=/var/www/html  plugin activate vits_coffee_finder
wp --allow-root --path=/var/www/html wc tool run install_pages --user=wordpress
chown -R 33:33 /var/www/html/wp-content/plugins

