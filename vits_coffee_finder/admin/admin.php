<?php
include 'question-function-mapping.php';

function vits_cf_number_of_questions_field_callback_function()
{
    echo "<input type='number' name='vits_cf_number_of_questions_field' class='vits_cf_number_of_questions_field' id='vits_cf_number_of_questions_field' min='1' max='100' value='" .
        get_option('vits_cf_number_of_questions_field', 1) . "'/>";
}

function vits_cf_number_of_questions_section_callback_function()
{
}

function vits_cf_question_field_callback_function($i)
{
    echo "<input type='text' name='vits_cf_question_field_" . $i . "' class='vits_cf_question_field' id='vits_cf_question_field_" . $i . "' value='" .
        get_option('vits_cf_question_field_' . $i, '') . "'/>";
}

function vits_cf_question_section_callback_function()
{
}

// only on question 0
function vits_cf_flavour_field_callback_function()
{
    echo "<textarea name='vits_cf_flavour_field' class='vits_cf_flavour_field' id='vits_cf_flavour_field' rows=4>" . get_option('vits_cf_flavour_field', '') . "</textarea>";
}

function vits_cf_number_of_answers_field_callback_function($i)
{
    echo "<input type='number' name='vits_cf_number_of_answers_field_" . $i . "' class='vits_cf_number_of_answers_field' id='vits_cf_number_of_answers_field_" . $i . "' min='2' max='20' value='" .
        get_option('vits_cf_number_of_answers_field_' . $i . '', 2) . "'/>";
}

function vits_cf_answer_field_callback_function($i, $j)
{
    echo "<input type='text' name='vits_cf_answer_field_" . $i . "_" . $j . "' class='vits_cf_answer_field' id='vits_cf_answer_field_" . $i . "_" . $j . "' value='" .
        get_option('vits_cf_answer_field_' . $i . '_' . $j, '') . "'/>";
}

function vits_cf_answer_section_callback_function()
{
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
    add_action('admin_enqueue_scripts', function() {
        wp_enqueue_style('admin', get_template_directory_uri() . '../../../plugins/vits_coffee_finder/css/admin.css');
    });
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
        for ($i = 0; $i < get_option('vits_cf_number_of_questions_field', 1); $i++) {
            add_settings_section(
                'vits_cf_question_section_' . $i,
                'Question ' . $i,
                'vits_cf_question_section_callback_function_' . $i,
                'reading'
            );
            add_settings_field(
                'vits_cf_question_field_' . $i,
                'Question Text',
                'vits_cf_question_field_callback_function_' . $i,
                'reading',
                'vits_cf_question_section_' . $i,
                [
                    'label_for' => 'vits_cf_question_field_' . $i
                ]
            );
            register_setting('question_group', 'vits_cf_question_field_' . $i);
            if ($i == 0) {
                add_settings_field(
                    'vits_cf_flavour_field',
                    'Flavour Text',
                    'vits_cf_flavour_field_callback_function',
                    'reading',
                    'vits_cf_question_section_' . $i,
                    [
                        'label_for' => 'vits_cf_flavour_field'
                    ]
                );
                register_setting('question_group', 'vits_cf_flavour_field');
            }
            add_settings_field(
                'vits_cf_number_of_answers_field_' . $i,
                'Number of Answers',
                'vits_cf_number_of_answers_field_callback_function_' . $i,
                'reading',
                'vits_cf_question_section_' . $i,
                [
                    'label_for' => 'vits_cf_number_of_answers_field_' . $i
                ]
            );
            register_setting('question_group', 'vits_cf_number_of_answers_field_' . $i);
            for ($j = 0; $j < get_option('vits_cf_number_of_answers_field_' . $i, 2); $j++) {
                add_settings_field(
                    'vits_cf_answer_field_' . $i . '_' . $j,
                    'Answer ' . $j,
                    'vits_cf_answer_field_callback_function_' . $i . '_' . $j,
                    'reading',
                    'vits_cf_question_section_' . $i,
                    [
                        'label_for' => 'vits_cf_answer_field_' . $i . '_' . $j
                    ]
                );
                register_setting('question_group', 'vits_cf_answer_field_' . $i . '_' . $j);
            }
        }
    });
}