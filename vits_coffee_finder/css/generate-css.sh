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
pwd=$(pwd)
if [[ $pwd =~ "vits_coffee_finder" ]]; then
  if [[ $pwd =~ "css" ]]; then
    sass *.scss
  else
    sass ./css/*.scss
  fi
else
  sass ./vits_coffee_finder/css/*.scss
fi
echo "Done."
