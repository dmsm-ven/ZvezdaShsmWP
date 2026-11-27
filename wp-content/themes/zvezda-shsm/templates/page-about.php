<?php
/**
 * Template Name: О клубе
 * Template Post Type: page
 */
get_header();
get_template_part('template-parts/sections/page-banner');

$who_image = zvezda_inner_page_field('about_who_image', []);
$who_image_alt = zvezda_inner_page_field('about_who_image_alt', '');
if ($who_image_alt === '' && is_array($who_image)) $who_image_alt = $who_image['alt'] ?? '';

$philosophy_image = zvezda_inner_page_field('about_philosophy_image', []);
$philosophy_image_alt = zvezda_inner_page_field('about_philosophy_image_alt', '');
if ($philosophy_image_alt === '' && is_array($philosophy_image)) $philosophy_image_alt = $philosophy_image['alt'] ?? '';

$community_image = zvezda_inner_page_field('about_community_image', []);
$community_image_alt = zvezda_inner_page_field('about_community_image_alt', '');
if ($community_image_alt === '' && is_array($community_image)) $community_image_alt = $community_image['alt'] ?? '';
?>

<section class="section about-section">
  <div class="wrap split reveal <?php echo !empty($who_image['ID']) ? 'has-image' : ''; ?>">
    <div class="prose">
      <div class="kicker"><?php echo esc_html(zvezda_inner_page_field('about_who_kicker', 'Кто мы')); ?></div>
      <h2><?php echo esc_html(zvezda_inner_page_field('about_who_title', 'Клуб, где ребёнка учат играть')); ?></h2>
      <?php for ($i = 1; $i <= 3; $i++) :
        $paragraph = trim((string) zvezda_inner_page_field("about_who_text_{$i}", ''));
        if ($paragraph !== '') : ?><p><?php echo esc_html($paragraph); ?></p><?php endif;
      endfor; ?>
    </div>
    <?php if (!empty($who_image['ID'])) : ?>
      <?php echo wp_get_attachment_image((int) $who_image['ID'], 'large', false, ['alt' => $who_image_alt, 'loading' => 'lazy']); ?>
    <?php endif; ?>
  </div>
</section>

<section class="section about-section about-section-soft">
  <div class="wrap split reveal <?php echo !empty($philosophy_image['ID']) ? 'has-image' : ''; ?>">
    <div class="prose">
      <div class="kicker"><?php echo esc_html(zvezda_inner_page_field('about_philosophy_kicker', 'Философия')); ?></div>
      <h2><?php echo esc_html(zvezda_inner_page_field('about_philosophy_title', 'Играй. Общайся. Расти. Развивайся.')); ?></h2>
      <?php $philosophy_text = trim((string) zvezda_inner_page_field('about_philosophy_text', '')); ?>
      <?php if ($philosophy_text !== '') : ?><p><?php echo esc_html($philosophy_text); ?></p><?php endif; ?>
      <?php
      $philosophy_button_text = zvezda_inner_page_field('about_philosophy_button_text', 'Философия клуба');
      $philosophy_button_url = zvezda_inner_page_field('about_philosophy_button_url', home_url('/philosophy/'));
      ?>
      <?php if ($philosophy_button_text !== '' && $philosophy_button_url !== '') : ?>
        <a class="btn btn-p about-philosophy-button" href="<?php echo esc_url($philosophy_button_url); ?>"><?php echo esc_html($philosophy_button_text); ?></a>
      <?php endif; ?>
    </div>
    <?php if (!empty($philosophy_image['ID'])) : ?>
      <?php echo wp_get_attachment_image((int) $philosophy_image['ID'], 'large', false, ['alt' => $philosophy_image_alt, 'loading' => 'lazy']); ?>
    <?php endif; ?>
  </div>
</section>

<section class="section about-section">
  <div class="wrap split reveal <?php echo !empty($community_image['ID']) ? 'has-image' : ''; ?>">
    <?php if (!empty($community_image['ID'])) : ?>
      <?php echo wp_get_attachment_image((int) $community_image['ID'], 'large', false, ['alt' => $community_image_alt, 'loading' => 'lazy']); ?>
    <?php endif; ?>
    <div class="prose">
      <div class="kicker"><?php echo esc_html(zvezda_inner_page_field('about_community_kicker', 'Сообщество')); ?></div>
      <h2><?php echo esc_html(zvezda_inner_page_field('about_community_title', 'Часть международного сообщества Super Nova')); ?></h2>
      <?php for ($i = 1; $i <= 2; $i++) :
        $paragraph = trim((string) zvezda_inner_page_field("about_community_text_{$i}", ''));
        if ($paragraph !== '') : ?><p><?php echo esc_html($paragraph); ?></p><?php endif;
      endfor; ?>
    </div>
  </div>
</section>

<?php
get_template_part('template-parts/sections/signup');
get_footer();
