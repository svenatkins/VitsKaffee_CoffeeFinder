<?php

function vits_cf_question_field_callback_function() {
    echo "<input type='checkbox' name='vits_cf_question_field' id='vits_cf_question_field' value='1'" .
        checked(1, get_option('vits_cf_question_field'), false) .
        "/>";
}

function vits_cf_question_section_callback_function() {
    echo '<p>Fill in your questions and answers</p>';
}

function vits_cf_admin_plugin()
{
    ?>
    <h1>Coffee Finder</h1>
    <form method="POST" action="options.php">
    <?php
    settings_fields( 'question_group' );
    do_settings_sections('reading');
    submit_button();
    ?>
    </form>
    <?php
}

function vits_cf_setup_admin_plugin()
{
    add_action('admin_menu', function () {
        add_menu_page(
            __('Coffee-Finder', 'coffee-finder'),
            __('Coffee Finder', 'coffee-finder'),
            "manage_options",
            "coffee-finder-plugin",
            'vits_cf_admin_plugin',
            'dashicons-products',
            79);
        add_settings_section(
            'vits_cf_question_section',
            'Manage Questions and Answers',
            'vits_cf_question_section_callback_function',
            'reading'
        );
        add_settings_field(
            'vits_cf_question_field',
            'Question 0',
            'vits_cf_question_field_callback_function',
            'reading',
            'vits_cf_question_section',
            [
                'label_for' => 'vits_cf_question_field'
            ]
        );
        register_setting('question_group', 'vits_cf_question_field');
    });
}