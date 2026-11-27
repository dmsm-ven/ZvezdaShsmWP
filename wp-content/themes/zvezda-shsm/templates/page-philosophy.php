<?php
/**
 * Template Name: Философия
 * Template Post Type: page
 */
get_header();
get_template_part('template-parts/sections/page-banner');

$goals_image = zvezda_inner_page_field('philosophy_goals_image', []);
$goals_image_alt = zvezda_inner_page_field('philosophy_goals_image_alt', '');
if ($goals_image_alt === '' && is_array($goals_image)) $goals_image_alt = $goals_image['alt'] ?? '';

$method_image = zvezda_inner_page_field('philosophy_method_image', []);
$method_image_alt = zvezda_inner_page_field('philosophy_method_image_alt', '');
if ($method_image_alt === '' && is_array($method_image)) $method_image_alt = $method_image['alt'] ?? '';

$priority_icons = [
    '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l7 3v5c0 4.6-3 8.2-7 10-4-1.8-7-5.4-7-10V6z"></path><path d="M9 12l2 2 4-4"></path></svg>',
    '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M8.5 14s1.3 1.8 3.5 1.8 3.5-1.8 3.5-1.8M9 10h.01M15 10h.01"></path></svg>',
    '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s-7-4.6-7-10a7 7 0 0114 0c0 5.4-7 10-7 10z" transform="translate(0,-1)"></path><path d="M9 11l2 2 4-4"></path></svg>',
];
?>
<section class="section philosophy-section philosophy-section-light">
  <div class="wrap reveal">
    <div class="kicker"><?php echo esc_html(zvezda_inner_page_field('philosophy_priorities_kicker', 'Наши приоритеты')); ?></div>
    <h2><?php echo esc_html(zvezda_inner_page_field('philosophy_priorities_title', 'На чём строится работа школы')); ?></h2>
    <div class="grid g3 philosophy-priorities">
      <?php for ($i = 1; $i <= 3; $i++) :
        $title = zvezda_inner_page_field("philosophy_priority_{$i}_title", '');
        $text = zvezda_inner_page_field("philosophy_priority_{$i}_text", '');
        if ($title === '' && $text === '') continue;
      ?>
        <div class="card">
          <div class="ico"><?php echo $priority_icons[$i - 1]; ?></div>
          <h3><?php echo esc_html($title); ?></h3>
          <p><?php echo esc_html($text); ?></p>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<section class="section philosophy-section philosophy-section-dark">
  <div class="wrap split reveal <?php echo (is_array($goals_image) && !empty($goals_image['ID'])) ? 'has-image' : ''; ?>">
    <div class="prose">
      <div class="kicker"><?php echo esc_html(zvezda_inner_page_field('philosophy_goals_kicker', 'Цели школы')); ?></div>
      <h2><?php echo esc_html(zvezda_inner_page_field('philosophy_goals_title', 'Что мы делаем')); ?></h2>
      <ul class="checklist">
        <?php for ($i = 1; $i <= 7; $i++) :
          $goal = trim((string) zvezda_inner_page_field("philosophy_goal_{$i}", ''));
          if ($goal !== '') : ?><li><?php echo esc_html($goal); ?></li><?php endif;
        endfor; ?>
      </ul>
    </div>
    <?php if (!empty($goals_image['ID'])) : ?>
      <?php echo wp_get_attachment_image((int) $goals_image['ID'], 'large', false, ['alt' => $goals_image_alt, 'loading' => 'lazy']); ?>
    <?php endif; ?>
  </div>
</section>

<section class="section philosophy-section philosophy-section-light">
  <div class="wrap split reveal <?php echo (is_array($method_image) && !empty($method_image['ID'])) ? 'has-image' : ''; ?>">
    <?php if (!empty($method_image['ID'])) : ?>
      <?php echo wp_get_attachment_image((int) $method_image['ID'], 'large', false, ['alt' => $method_image_alt, 'loading' => 'lazy']); ?>
    <?php endif; ?>
    <div class="prose">
      <div class="kicker"><?php echo esc_html(zvezda_inner_page_field('philosophy_method_kicker', 'Как мы работаем')); ?></div>
      <h2><?php echo esc_html(zvezda_inner_page_field('philosophy_method_title', 'Единая методика во всех группах')); ?></h2>
      <?php for ($i = 1; $i <= 3; $i++) :
        $paragraph = trim((string) zvezda_inner_page_field("philosophy_method_text_{$i}", ''));
        if ($paragraph !== '') : ?><p><?php echo esc_html($paragraph); ?></p><?php endif;
      endfor; ?>
    </div>
  </div>
</section>

<?php
get_template_part('template-parts/sections/signup');
get_footer();
