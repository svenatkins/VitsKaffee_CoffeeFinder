#!/bin/bash
apt-get update
apt-get install less

# install WPCli
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
mv wp-cli.phar /usr/local/bin/wp

OPTS=("--allow-root" "--path=/var/www/html")

# Install WP
wp "${OPTS[@]}" core install --url=http://localhost:8080/  --title=vits-test --admin_user=wordpress --admin_password=wordpress --admin_email=somwhere@domain.tld --skip-email
wp "${OPTS[@]}" rewrite structure '/%postname%/'
wp "${OPTS[@]}" plugin install wp-extended-search

# Install any other theme
wp "${OPTS[@]}" theme install storefront
wp "${OPTS[@]}" theme activate storefront

# setup Custom landing page
cp /root/vits_coffee_finder_landing_page.php /var/www/html/wp-content/themes/storefront/vits_coffee_finder_landing_page.php

EXISTING=$(wp --allow-root --path=/var/www/html post list --post_type=page --format=csv| grep "Coffee Finder" | cut -d',' -f1)
if [[ ! -z $EXISTING ]]; then
  echo "-->delete old entry/entries"
  wp "${OPTS[@]}" post delete $EXISTING
fi
wp "${OPTS[@]}" post create   --post_type='page' \
                              --guid='http://localhost:8080/coffee-finder/' \
                              --post-template='Landing Page Vits' \
                              --post_title='Coffee Finder' \
                              --post_name='Coffee Finder' \
                              --post_status='publish' \
                              --post_content='[coffee-finder]' \
                              --meta_input='{"_wp_page_template":"vits_coffee_finder_landing_page.php"}'

# Install Woocommerce
wp "${OPTS[@]}" plugin install woocommerce
wp "${OPTS[@]}" plugin activate woocommerce
wp "${OPTS[@]}" plugin activate vits_coffee_finder
wp "${OPTS[@]}" plugin activate show-single-variations-premium
wp "${OPTS[@]}" wc tool run install_pages --user=wordpress

chown -R $USER_ID:33 /var/www/html/wp-content/plugins
chown -R $USER_ID:33 /var/www/html/wp-content/themes

