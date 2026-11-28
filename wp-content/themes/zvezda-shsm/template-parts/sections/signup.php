<?php
/**
 * Shared signup section used on the homepage and inner pages.
 * Its editable content is stored on the WordPress front page.
 */
$signup_photo = zvezda_front_page_field('signup_photo', null);
$signup_photo_id = 0;
$signup_photo_url = '';

// Read the raw ACF value as an attachment ID. This avoids differences
// between ACF image return formats on local and production environments.
if (function_exists('get_field')) {
    $front_page_id = (int) get_option('page_on_front');
    $raw_signup_photo = get_field('signup_photo', $front_page_id ?: false, false);

    if (is_numeric($raw_signup_photo)) {
        $signup_photo_id = absint($raw_signup_photo);
    } elseif (is_array($raw_signup_photo)) {
        $signup_photo_id = !empty($raw_signup_photo['ID'])
            ? absint($raw_signup_photo['ID'])
            : (!empty($raw_signup_photo['id']) ? absint($raw_signup_photo['id']) : 0);
        $signup_photo_url = !empty($raw_signup_photo['url']) ? $raw_signup_photo['url'] : '';
    } elseif (is_object($raw_signup_photo) && !empty($raw_signup_photo->ID)) {
        $signup_photo_id = absint($raw_signup_photo->ID);
    } elseif (is_string($raw_signup_photo) && filter_var($raw_signup_photo, FILTER_VALIDATE_URL)) {
        $signup_photo_url = $raw_signup_photo;
    }
}

// Keep compatibility with formatted ACF values if the raw value is unavailable.
if (!$signup_photo_id && is_array($signup_photo)) {
    $signup_photo_id = !empty($signup_photo['ID'])
        ? absint($signup_photo['ID'])
        : (!empty($signup_photo['id']) ? absint($signup_photo['id']) : 0);
    if ($signup_photo_url === '' && !empty($signup_photo['url'])) {
        $signup_photo_url = $signup_photo['url'];
    }
} elseif (!$signup_photo_id && is_numeric($signup_photo)) {
    $signup_photo_id = absint($signup_photo);
} elseif ($signup_photo_url === '' && is_string($signup_photo) && filter_var($signup_photo, FILTER_VALIDATE_URL)) {
    $signup_photo_url = $signup_photo;
}

if ($signup_photo_id && $signup_photo_url === '') {
    $signup_photo_url = wp_get_attachment_url($signup_photo_id) ?: '';
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
      <?php if ($signup_photo_id) : ?>
        <?php
        $signup_photo_html = wp_get_attachment_image($signup_photo_id, 'large', false, [
            'class' => 'photo',
            'alt' => $signup_photo_alt,
            'loading' => 'lazy',
            'decoding' => 'async',
        ]);
        ?>
        <?php if ($signup_photo_html !== '') : ?>
          <?php echo $signup_photo_html; ?>
        <?php elseif ($signup_photo_url !== '') : ?>
          <img class="photo" src="<?php echo esc_url($signup_photo_url); ?>" alt="<?php echo esc_attr($signup_photo_alt); ?>" loading="lazy" decoding="async">
        <?php endif; ?>
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
