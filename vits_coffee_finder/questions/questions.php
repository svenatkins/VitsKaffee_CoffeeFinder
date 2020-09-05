<?php

include 'class-question.php';

$question0 = new Question('Wie viele Kartoffeln im Kaffee mögen Sie so?',
    '0 bis 1',
    '2 bis 5',
    'über 5');

$question1 = new Question('Und Möhrchen?',
    '0 bis 1',
    '2 bis 5',
    'über 5');

$question2 = new Question('Und Knoblauchzehen?',
    '0 bis 1',
    '2 bis 5',
    'über 5');

$questions = array($question0, $question1, $question2);