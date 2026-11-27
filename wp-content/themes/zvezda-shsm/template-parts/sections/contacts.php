<?php $map_embed_url = zvezda_map_embed_url(); ?>
<section class="section contacts" id="contacts">
  <div class="wrap reveal">
    <div class="kicker">Контакты</div>
    <h2>Как нас найти</h2>
    <div class="grid <?php echo $map_embed_url ? 'g2' : ''; ?>" style="margin-top:28px">
      <div class="card">
        <p><b>Адрес:</b> <?php echo esc_html(zvezda_setting('address')); ?></p>
        <p><b>Телефон:</b> <a href="<?php echo esc_url('tel:' . zvezda_phone_href()); ?>"><?php echo esc_html(zvezda_setting('phone')); ?></a></p>
        <p><b>E-mail:</b> <a href="<?php echo esc_url('mailto:' . zvezda_setting('email')); ?>"><?php echo esc_html(zvezda_setting('email')); ?></a></p>
        <p><b>Мессенджеры:</b> <a href="https://wa.me/<?php echo esc_attr(zvezda_phone_digits()); ?>">WhatsApp</a> · <a href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>">Telegram</a></p>
        <p><b>Соцсети:</b> <a href="<?php echo esc_url(zvezda_setting('vk_url')); ?>">VK</a> · <a href="<?php echo esc_url(zvezda_setting('youtube_url')); ?>">YouTube</a></p>
      </div>
      <?php if ($map_embed_url) : ?>
        <div class="map-embed">
          <iframe
            src="<?php echo esc_url($map_embed_url); ?>"
            title="Карта расположения футбольного клуба"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen
          ></iframe>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
