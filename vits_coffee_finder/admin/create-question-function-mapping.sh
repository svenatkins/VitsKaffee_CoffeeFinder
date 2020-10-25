#!/bin/bash

# script for creating the question-function-mapping.php file

FILE=question-function-mapping.php
if test -f "$FILE"; then
  echo "$FILE exists. Want to recreate it?"
  select yn in "Yes" "No"; do
    case $yn in
    Yes)
      echo "Alrighty, will do."
      break
      ;;
    No)
      echo "K, bye."
      exit
      ;;
    esac
  done
else
  echo "$FILE does not exist, will create it."
  touch $FILE
fi

echo "<?php" >$FILE
echo "// This file was created automatically by usage of the create-question-function-mapping.sh script." >>$FILE
echo "// The functions in here are used in the admin.php file." >>$FILE
for i in {0..99}; do
  echo "function vits_cf_question_section_callback_function_$i()" >>$FILE
  echo "{" >>$FILE
  echo "    vits_cf_question_section_callback_function($i);" >>$FILE
  echo "}" >>$FILE
  echo "" >>$FILE
  echo "function vits_cf_question_field_callback_function_$i()" >>$FILE
  echo "{" >>$FILE
  echo "    vits_cf_question_field_callback_function($i);" >>$FILE
  echo "}" >>$FILE
  echo "" >>$FILE
  echo "function vits_cf_number_of_answers_field_callback_function_$i()" >>$FILE
  echo "{" >>$FILE
  echo "    vits_cf_number_of_answers_field_callback_function($i);" >>$FILE
  echo "}" >>$FILE
  echo "" >>$FILE
  for j in {0..19}; do
    echo "function vits_cf_answer_field_callback_function_${i}_${j}()" >>$FILE
    echo "{" >>$FILE
    echo "    vits_cf_answer_field_callback_function($i, $j);" >>$FILE
    echo "}" >>$FILE
    echo "" >>$FILE
  done
done

echo "Done!"
