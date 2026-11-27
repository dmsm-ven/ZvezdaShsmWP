<?php
/**
 * Single template for standard WordPress posts used as Useful materials.
 */
get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <?php $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
  <section class="page-hero useful-post-hero"<?php if ($featured_image) : ?> style="--useful-post-background-image: url('<?php echo esc_url($featured_image); ?>')"<?php endif; ?>>
    <div class="wrap">
      <div class="kicker">Полезное</div>
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
