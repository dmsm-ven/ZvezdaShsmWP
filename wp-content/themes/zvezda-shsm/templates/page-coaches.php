<?php
/**
 * Template Name: Тренеры
 * Template Post Type: page
 */
get_header();
get_template_part('template-parts/sections/page-banner');

$coaches = new WP_Query([
    'post_type' => 'coach',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => [
        'menu_order' => 'ASC',
        'date' => 'ASC',
    ],
    'no_found_rows' => true,
]);
?>
<section class="section coaches-directory">
  <div class="wrap reveal">
    <?php if ($coaches->have_posts()) : ?>
      <div class="grid g2">
        <?php while ($coaches->have_posts()) : $coaches->the_post();
          $coach_id = get_the_ID();
          $coach_name = function_exists('get_field') ? get_field('coach_full_name', $coach_id) : '';
          $coach_titles = get_post_meta($coach_id, '_coach_titles_list', true);
          if (!is_array($coach_titles) || !$coach_titles) {
            $legacy_titles = function_exists('get_field') ? get_field('coach_titles', $coach_id) : '';
            $coach_titles = $legacy_titles ? preg_split('/\\s*·\\s*|\\r?\\n/', $legacy_titles) : [];
          }
          $coach_titles = array_filter(array_map('trim', $coach_titles));
          $coach_titles_text = implode(' · ', $coach_titles);
          $coach_description = function_exists('get_field') ? get_field('coach_description', $coach_id) : '';
          $coach_experience = function_exists('get_field') ? get_field('coach_experience', $coach_id) : '';
          $coach_image = get_the_post_thumbnail_url($coach_id, 'large');
        ?>
          <article class="coach2">
            <?php if ($coach_image) : ?>
              <img src="<?php echo esc_url($coach_image); ?>" alt="<?php echo esc_attr($coach_name ?: get_the_title()); ?>" loading="lazy">
            <?php endif; ?>
            <div class="coach2-content">
              <h2><?php echo esc_html($coach_name ?: get_the_title()); ?></h2>
              <?php if ($coach_titles_text) : ?><div class="role"><?php echo esc_html($coach_titles_text); ?></div><?php endif; ?>
              <?php if ($coach_description) : ?><p><?php echo nl2br(esc_html($coach_description)); ?></p><?php endif; ?>
              <?php if ($coach_experience) : ?><p>Опыт: <?php echo nl2br(esc_html($coach_experience)); ?></p><?php endif; ?>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
      <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <p class="coaches-directory-empty">Информация о тренерах скоро появится.</p>
    <?php endif; ?>
  </div>
</section>

<?php
get_template_part('template-parts/sections/signup');
get_footer();
