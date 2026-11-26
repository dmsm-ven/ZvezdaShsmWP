<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php $promo = zvezda_opt('promo_text', 'Идёт набор в группы — первая тренировка бесплатно'); ?>
<?php if ($promo) : ?>
<div class="promo" id="promo" hidden>
  <div class="promo__inner">
    <span><?php echo esc_html($promo); ?></span>
    <a href="<?php echo esc_url(home_url('/#signup')); ?>">Записаться</a>
    <button class="promo__close" type="button" aria-label="Закрыть">&times;</button>
  </div>
</div>
<?php endif; ?>

<header class="site-header">
  <div class="container site-header__inner">
    <a class="site-brand" href="<?php echo esc_url(home_url('/')); ?>">
      <?php if (has_custom_logo()) { the_custom_logo(); } ?>
      <span>ФК «Звезда ШСМ»</span>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">Меню</button>

    <nav class="site-nav" id="site-nav" aria-label="Главное меню">
      <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'fallback_cb' => false]); ?>
    </nav>

    <?php $phone = zvezda_opt('phone', '+7 (000) 000-00-00'); ?>
    <a class="site-header__phone" href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
    <div class="site-header__cta"><a class="btn" href="<?php echo esc_url(home_url('/#signup')); ?>">Пробная тренировка</a></div>
  </div>
</header>
<main id="content">
