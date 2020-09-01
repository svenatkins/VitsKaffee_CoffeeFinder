#!/bin/bash

OPTS=("--allow-root" "--path=/var/www/html")

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

chown -R $USER_ID:33 /var/www/html/wp-content/plugins
chown -R $USER_ID:33 /var/www/html/wp-content/themes

