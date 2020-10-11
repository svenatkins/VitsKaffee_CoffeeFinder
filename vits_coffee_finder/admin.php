<?php
include 'question-function-mapping.php';

function vits_cf_number_of_questions_field_callback_function()
{
    echo "<input type='number' name='vits_cf_number_of_questions_field' id='vits_cf_number_of_questions_field' min='1' max='100' value='" .
        get_option('vits_cf_number_of_questions_field') . "'/>";
}

function vits_cf_number_of_questions_section_callback_function()
{
}

function vits_cf_question_field_callback_function($i)
{
    echo "<input type='checkbox' name='vits_cf_question_field_" . $i . "' id='vits_cf_question_field_" . $i . "' value='1'" .
        checked(1, get_option('vits_cf_question_field_' . $i), false) .
        "/>";
}

function vits_cf_question_section_callback_function()
{
    echo '<p>Fill in your questions and answers</p>';
}

function vits_cf_admin_plugin()
{
    ?>
    <h1>Coffee Finder</h1>
    <form method="POST" action="options.php">
        <?php
        settings_fields('question_group');
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
            'vits_cf_number_of_questions_section',
            'Adjust the Number of Questions',
            'vits_cf_number_of_questions_section_callback_function',
            'reading'
        );
        add_settings_field(
            'vits_cf_number_of_questions_field',
            'Number of Questions',
            'vits_cf_number_of_questions_field_callback_function',
            'reading',
            'vits_cf_number_of_questions_section',
            [
                'label_for' => 'vits_cf_number_of_questions_field'
            ]
        );
        register_setting('question_group', 'vits_cf_number_of_questions_field');
        add_settings_section(
            'vits_cf_question_section',
            'Manage Questions and Answers',
            'vits_cf_question_section_callback_function',
            'reading'
        );
        for ($i = 0; $i < get_option('vits_cf_number_of_questions_field', 1); $i++) {
            add_settings_field(
                'vits_cf_question_field_' . $i,
                'Question ' . $i,
                'vits_cf_question_field_callback_function_' . $i,
                'reading',
                'vits_cf_question_section',
                [
                    'label_for' => 'vits_cf_question_field_' . $i
                ]
            );
            register_setting('question_group', 'vits_cf_question_field_' . $i);
        }
    });
}