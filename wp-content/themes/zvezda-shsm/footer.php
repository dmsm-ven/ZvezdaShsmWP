</main>
<footer class="footer">
  <div class="wrap">
    <div class="top">
      <div>
        <div class="flogo"><img src="<?php echo esc_url(zvezda_club_logo_url()); ?>" alt="<?php echo esc_attr(zvezda_setting('club_name')); ?>"><?php echo esc_html(zvezda_setting('club_name')); ?></div>
        <p><?php echo esc_html(zvezda_setting('footer_description')); ?></p>
      </div>
      <div class="col">
        <h4>Разделы</h4>
        <a href="<?php echo esc_url(home_url('/about/')); ?>">О клубе</a>
        <a href="<?php echo esc_url(home_url('/philosophy/')); ?>">Философия</a>
        <a href="<?php echo esc_url(home_url('/coaches/')); ?>">Тренеры</a>
        <a href="<?php echo esc_url(home_url('/schedule/')); ?>">Расписание и цены</a>
        <a href="<?php echo esc_url(home_url('/media/')); ?>">Медиа</a>
        <a href="<?php echo esc_url(home_url('/useful/')); ?>">Полезное</a>
        <a href="<?php echo esc_url(home_url('/payment/')); ?>">Оплата</a>
      </div>
      <div class="col">
        <h4>Контакты</h4>
        <a href="<?php echo esc_url('tel:' . zvezda_phone_href()); ?>"><?php echo esc_html(zvezda_setting('phone')); ?></a>
        <a href="<?php echo esc_url('mailto:' . zvezda_setting('email')); ?>"><?php echo esc_html(zvezda_setting('email')); ?></a>
        <a href="https://wa.me/79856692689">WhatsApp</a>
        <a href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>">Telegram</a>
        <a href="<?php echo esc_url(zvezda_setting('vk_url')); ?>">VK</a>
        <a href="https://www.instagram.com/fcsupernovamoscow" target="_blank" rel="noopener">Instagram</a>
      </div>
    </div>
    <div class="bottom">
      <div>© <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html(zvezda_setting('club_name')); ?> Москва</div>
      <div><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Политика конфиденциальности</a> · <a href="<?php echo esc_url(home_url('/user-agreement/')); ?>">Пользовательское соглашение</a></div>
    </div>
  </div>
</footer>
<div class="float-wa"><a href="https://wa.me/79856692689" aria-label="WhatsApp">✆</a></div>
<div class="sticky-cta"><a href="#signup">Записаться на бесплатную тренировку</a></div>
<?php wp_footer(); ?>
</body>
</html>