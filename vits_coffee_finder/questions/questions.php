<?php

# this file feeds the questions from the admin area into the user area

include 'VitsCfQuestion.php';

$vitsCfQuestions = array();

for ($i = 0; $i < get_option('vits_cf_number_of_questions_field', 1); $i++) {
    $vitsCfAnswers = array();
    for ($j = 0; $j < get_option('vits_cf_number_of_answers_field_' . $i, 1); $j++) {
        array_push($vitsCfAnswers, get_option('vits_cf_answer_field_' . $i . '_' . $j, ''));
    }
    // question 0 has flavour text
    if ($i == 0) {
        array_push($vitsCfQuestions, new VitsCfQuestion(get_option('vits_cf_question_field_' . $i), get_option('vits_cf_flavour_field', ''), $vitsCfAnswers));
    } else {
        array_push($vitsCfQuestions, new VitsCfQuestion(get_option('vits_cf_question_field_' . $i), null, $vitsCfAnswers));
    }
}