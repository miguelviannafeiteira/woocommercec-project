<?php
// Template name: Home
get_header();?>

<?php if(have_posts()) { while(have_posts()) { the_post()?>

  <main><?php the_content()?></main>
  <?php } } ?>
<?php get_footer();?>
