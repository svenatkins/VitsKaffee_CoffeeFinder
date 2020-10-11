<?php

# this file feeds the questions from the admin area into the user area

include 'VitsCfQuestion.php';

$vitsCfQuestions = array();

for ($i = 0; $i < get_option('vits_cf_number_of_questions_field', 1); $i++) {
    $vitsCfAnswers = array();
    for ($j = 0; $j < 3; $j++) { // TODO Change when number of answers is flexible, too
        array_push($vitsCfAnswers, get_option('vits_cf_answer_field_' . $i . '_' . $j, ''));
    }
    array_push($vitsCfQuestions, new VitsCfQuestion(get_option('vits_cf_question_field_' . $i), $vitsCfAnswers));
}