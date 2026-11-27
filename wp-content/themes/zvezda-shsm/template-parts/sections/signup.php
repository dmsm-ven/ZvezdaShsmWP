<?php
/**
 * Shared signup section used on the homepage and inner pages.
 * Its editable content is stored on the WordPress front page.
 */
$signup_photo = zvezda_front_page_field('signup_photo', []);
$signup_photo_url = is_array($signup_photo) && !empty($signup_photo['url'])
    ? $signup_photo['url']
    : get_theme_file_uri('/assets/images/boys.jpg');
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
      <img class="photo" src="<?php echo esc_url($signup_photo_url); ?>" alt="<?php echo esc_attr($signup_photo_alt); ?>" loading="lazy">
    </div>
    <div class="form signup-form-card">
      <h3>Записаться на пробную тренировку</h3>
      <?php echo do_shortcode('[contact-form-7 id="1221567" title="Контактная форма"]'); ?>
    </div>
  </div>
</section>
