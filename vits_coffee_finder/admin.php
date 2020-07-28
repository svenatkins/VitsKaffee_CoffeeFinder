<?php
function vits_cf_admin_plugin(){
    ?><h1>Coffee Finder</h1>
    <p>manage hierarchic tags and other options here, it necessary</p>
    <?php
}

function vits_cd_setup_admin_plugin()
{
    add_action('admin_menu', function () {
        add_menu_page(
            __('Coffee-Finder', 'coffee-finder'),
            __('Coffee Finder', 'coffee-finder'),
            "manage_options",
            "coffee-finder-plugin",
            'vits_cf_admin_plugin',
            'dashicons-products', 79);
    });
}