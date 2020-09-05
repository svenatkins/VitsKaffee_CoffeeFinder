<?php
session_start();
?>

<?php include '/var/www/html/wp-content/plugins/vits_coffee_finder/questions/vits-coffee-finder.php' ?>

<?php
// todo: optimise readability?
if (have_posts()) : while (have_posts()) : the_post();
    the_content();
endwhile; endif;
?>


