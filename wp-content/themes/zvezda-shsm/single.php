<?php
/**
 * Single template for standard WordPress posts used as Useful materials.
 */
get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <section class="page-hero useful-post-hero">
    <div class="wrap">
      <div class="kicker">— Полезное</div>
      <h1><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="section useful-article-section">
    <article class="wrap reveal useful-article">
      <div class="useful-article-content">
        <?php the_content(); ?>
      </div>
      <a class="btn btn-g useful-all-link" href="<?php echo esc_url(home_url('/useful/')); ?>">← Все материалы</a>
    </article>
  </section>
<?php endwhile; endif; ?>

<?php
get_template_part('template-parts/sections/signup');
get_footer();
