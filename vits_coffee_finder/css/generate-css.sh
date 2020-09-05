#!/bin/bash

# This script requires installation of homebrew.

echo "Check if sass is installed."

infoOutput=$(brew info sass)

if [[ $infoOutput =~ "Not installed" ]]; then
  echo "sass is not installed, will install now."
  brew install sass/sass/sass
else
  echo "sass is already installed."
fi

echo "Generate CSS code from SCSS code."
cd vits_coffee_finder/css

for file in *.scss; do
  echo "Processing $file file ...";
  sass --no-source-map $file ${file%.*}.css
done

echo "Done."