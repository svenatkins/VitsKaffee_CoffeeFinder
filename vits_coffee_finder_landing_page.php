<?php /* Template Name: Landing Page Vits */ ?>


<h1>Hier könnte ihre Werbung stehen</h1>


<?php
// todo: optimise readability?
if (have_posts()) : while (have_posts()) : the_post();
    the_content();
endwhile; endif;
?>


