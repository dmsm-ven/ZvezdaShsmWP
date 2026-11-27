<?php
/**
 * Template Name: Медиа
 * Template Post Type: page
 */
get_header();
get_template_part('template-parts/sections/page-banner');
?>
<section class="section media-gallery-section">
  <div class="wrap reveal media-gallery-content">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
  </div>
</section>

<?php
get_template_part('template-parts/sections/video');
get_template_part('template-parts/sections/signup');
get_footer();
