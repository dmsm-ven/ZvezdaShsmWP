<?php
/**
 * Template Name: Оплата
 * Template Post Type: page
 */
get_header();
get_template_part('template-parts/sections/page-banner');
?>
<section class="section sched payment-tariffs-section">
  <div class="wrap reveal">
    <?php get_template_part('template-parts/sections/tariffs'); ?>
  </div>
</section>

<?php
get_template_part('template-parts/sections/signup');
get_footer();
