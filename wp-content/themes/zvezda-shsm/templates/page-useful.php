<?php
/**
 * Template Name: Полезное
 * Template Post Type: page
 */
get_header();
get_template_part('template-parts/sections/page-banner');

$current_page = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
$useful_posts = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 9,
    'paged' => $current_page,
    'orderby' => 'date',
    'order' => 'DESC',
]);
?>
<section class="section useful-archive-section">
  <div class="wrap reveal">
    <div class="kicker">Читать родителям</div>
    <h2>Как устроена школа</h2>

    <?php if ($useful_posts->have_posts()) : ?>
      <div class="grid g3 posts useful-posts-grid">
        <?php while ($useful_posts->have_posts()) : $useful_posts->the_post(); ?>
          <a class="card post-card" href="<?php the_permalink(); ?>">
            <div class="thumb">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', ['loading' => 'lazy', 'decoding' => 'async']); ?>
              <?php else : ?>
                <div class="post-thumb-placeholder" aria-hidden="true"></div>
              <?php endif; ?>
            </div>
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html(get_the_excerpt()); ?></p>
            <span class="more">Читать →</span>
          </a>
        <?php endwhile; ?>
      </div>

      <?php
      $pagination = paginate_links([
          'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
          'format' => '?paged=%#%',
          'current' => $current_page,
          'total' => (int) $useful_posts->max_num_pages,
          'prev_text' => '← Назад',
          'next_text' => 'Далее →',
          'type' => 'list',
      ]);
      if ($pagination) :
      ?>
        <nav class="useful-pagination" aria-label="Навигация по материалам">
          <?php echo wp_kses_post($pagination); ?>
        </nav>
      <?php endif; ?>
    <?php else : ?>
      <p class="useful-empty">Материалы скоро появятся.</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</section>

<?php
get_template_part('template-parts/sections/signup');
get_footer();
