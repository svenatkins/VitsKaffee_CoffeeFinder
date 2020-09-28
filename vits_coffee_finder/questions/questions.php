<?php

include 'VitsCfQuestion.php';

$vitsCfQuestion0 = new VitsCfQuestion('Wie viele Kartoffeln im Kaffee mögen Sie so?',
    '0 bis 1',
    '2 bis 5',
    'über 5');

$vitsCfQuestion1 = new VitsCfQuestion('Und Möhrchen?',
    '0 bis 1',
    '2 bis 5',
    'über 5');

$vitsCfQuestion2 = new VitsCfQuestion('Und Knoblauchzehen?',
    '0 bis 1',
    '2 bis 5',
    'über 5');

$vitsCfQuestions = array($vitsCfQuestion0, $vitsCfQuestion1, $vitsCfQuestion2);