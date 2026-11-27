<?php
$map_embed_url = zvezda_map_embed_url();
?>
<section class="section contacts contacts-page-layout" id="contacts">
  <div class="wrap reveal">
    <div class="kicker">Контакты</div>
    <h2>Как нас найти</h2>
  </div>

  <?php if ($map_embed_url) : ?>
    <div class="contacts-map-full">
      <iframe
        src="<?php echo esc_url($map_embed_url); ?>"
        title="Карта расположения футбольного клуба"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        allowfullscreen
      ></iframe>
    </div>
  <?php endif; ?>

  <div class="wrap reveal">
    <div class="contacts-details">
      <div class="contact-detail">
        <b>Адрес</b>
        <span><?php echo esc_html(zvezda_setting('address')); ?></span>
      </div>
      <div class="contact-detail">
        <b>Телефон</b>
        <a href="<?php echo esc_url('tel:' . zvezda_phone_href()); ?>"><?php echo esc_html(zvezda_setting('phone')); ?></a>
      </div>
      <div class="contact-detail">
        <b>E-mail</b>
        <a href="<?php echo esc_url('mailto:' . zvezda_setting('email')); ?>"><?php echo esc_html(zvezda_setting('email')); ?></a>
      </div>
      <div class="contact-detail">
        <b>Мессенджеры</b>
        <span><a href="https://wa.me/<?php echo esc_attr(zvezda_phone_digits()); ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a> · <a href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>" target="_blank" rel="noopener noreferrer">Telegram</a></span>
      </div>
      <div class="contact-detail">
        <b>Соцсети</b>
        <span><a href="<?php echo esc_url(zvezda_setting('vk_url')); ?>" target="_blank" rel="noopener noreferrer">VK</a> · <a href="<?php echo esc_url(zvezda_setting('youtube_url')); ?>" target="_blank" rel="noopener noreferrer">YouTube</a></span>
      </div>
    </div>
  </div>
</section>
