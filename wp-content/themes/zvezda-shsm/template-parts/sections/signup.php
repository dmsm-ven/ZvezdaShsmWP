<?php
/**
 * Shared signup section used on the homepage and inner pages.
 * Its editable content is stored on the WordPress front page.
 */
$front_page_id = (int) get_option('page_on_front');
$signup_photo = zvezda_front_page_field('signup_photo', null);
$raw_signup_photo = $front_page_id ? get_post_meta($front_page_id, 'signup_photo', true) : '';

$signup_photo_id = 0;
$signup_photo_url = '';

// Prefer the raw attachment ID saved by ACF. The formatted field value is
// also checked because ACF return formats can differ between environments.
$photo_values = [$raw_signup_photo, $signup_photo];
foreach ($photo_values as $photo_value) {
    if ($signup_photo_id || $signup_photo_url !== '') {
        break;
    }

    if (is_numeric($photo_value)) {
        $signup_photo_id = absint($photo_value);
    } elseif (is_array($photo_value)) {
        $signup_photo_id = !empty($photo_value['ID'])
            ? absint($photo_value['ID'])
            : (!empty($photo_value['id']) ? absint($photo_value['id']) : 0);

        if (!$signup_photo_id && !empty($photo_value['url'])) {
            $signup_photo_url = $photo_value['url'];
        }
    } elseif (is_object($photo_value) && !empty($photo_value->ID)) {
        $signup_photo_id = absint($photo_value->ID);
    } elseif (is_string($photo_value) && filter_var($photo_value, FILTER_VALIDATE_URL)) {
        $signup_photo_url = $photo_value;
    }
}

$signup_photo_html = '';
if ($signup_photo_id) {
    $signup_photo_html = wp_get_attachment_image($signup_photo_id, 'large', false, [
        'class' => 'photo',
        'alt' => '',
        'loading' => 'lazy',
        'decoding' => 'async',
    ]);

    // If WordPress cannot build the responsive image markup, use the
    // attachment URL directly rather than silently omitting the photo.
    if (!$signup_photo_html) {
        $signup_photo_url = wp_get_attachment_image_url($signup_photo_id, 'large')
            ?: wp_get_attachment_url($signup_photo_id)
            ?: '';
    }
}

$signup_photo_alt = zvezda_front_page_field('signup_photo_alt', '');
if ($signup_photo_alt === '') {
    $signup_photo_alt = is_array($signup_photo) && !empty($signup_photo['alt'])
        ? $signup_photo['alt']
        : 'Юные игроки ' . zvezda_setting('club_name');
}
?>
<section class="section signup" id="signup">
  <div class="wrap inner reveal">
    <div>
      <div class="kicker">Запись</div>
      <h2><?php echo esc_html(zvezda_front_page_field('signup_title', 'Первая тренировка — бесплатно')); ?></h2>
      <p><?php echo nl2br(esc_html(zvezda_front_page_field('signup_description', 'Оставьте заявку — перезвоним, подберём группу по возрасту и пригласим на пробное занятие. Или напишите нам в мессенджер, так быстрее.'))); ?></p>
      <div class="mess">
        <a class="btn" href="https://wa.me/<?php echo esc_attr(zvezda_phone_digits()); ?>">WhatsApp</a>
        <a class="btn" href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>">Telegram</a>
      </div>
      <?php if ($signup_photo_html) : ?>
        <?php
        // Apply the editable ALT text to the generated image markup.
        $signup_photo_html = preg_replace(
            '/alt=("|')(.*?)\\1/i',
            'alt="' . esc_attr($signup_photo_alt) . '"',
            $signup_photo_html,
            1
        );
        echo $signup_photo_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
      <?php elseif ($signup_photo_url !== '') : ?>
        <img class="photo" src="<?php echo esc_url($signup_photo_url); ?>" alt="<?php echo esc_attr($signup_photo_alt); ?>" loading="lazy" decoding="async">
      <?php endif; ?>
    </div>
    <div class="form signup-form-card">
      <h3>Записаться на пробную тренировку</h3>
      <?php echo do_shortcode('[contact-form-7 id="1221567" title="Контактная форма"]'); ?>
    </div>
  </div>
</section>
