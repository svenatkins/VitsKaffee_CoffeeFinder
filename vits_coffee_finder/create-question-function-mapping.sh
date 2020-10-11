#!/bin/bash

# script for creating the question-function-mapping.php file

FILE=question-function-mapping.php
if test -f "$FILE"; then
  echo "$FILE exists. Want to recreate it? (Y/n)"
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

echo "<?php" > $FILE
echo "// This file was created automatically by usage of the create-question-function-mapping.sh script." >> $FILE
echo "// The functions in here are used in the admin.php file." >> $FILE
for i in {0..99}
do
  echo "function vits_cf_question_field_callback_function_$i()" >> $FILE
  echo "{" >> $FILE
  echo "    vits_cf_question_field_callback_function($i);" >> $FILE
  echo "}" >> $FILE
  echo "" >> $FILE
done

echo "Done!"
