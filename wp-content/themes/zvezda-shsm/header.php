<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400;500;600;700&family=Inter+Tight:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="topbar" id="topbar">
  <div class="wrap">
    <span class="tb-text"><i class="tb-dot"></i><span class="tb-full">Открыт круглогодичный набор на сезон 2026/27 (дети 5–12 лет) — первая тренировка бесплатно</span><span class="tb-short">Набор 2026/27 · 5–12 лет · 1-я бесплатно</span></span>
    <a class="tb-btn" href="<?php echo esc_url(home_url('/#signup')); ?>">Записаться</a>
    <button class="tb-close" type="button" aria-label="Закрыть объявление">×</button>
  </div>
</div>

<header class="header">
  <div class="wrap">
    <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
      <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/logo.png')); ?>" alt="ФК Супер Нова">
      ФК «СУПЕР НОВА»
    </a>
    <nav class="nav">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="active">Главная</a>
      <a href="<?php echo esc_url(home_url('/about/')); ?>">О клубе</a>
      <a href="<?php echo esc_url(home_url('/philosophy/')); ?>">Философия</a>
      <a href="<?php echo esc_url(home_url('/coaches/')); ?>">Тренеры</a>
      <a href="<?php echo esc_url(home_url('/schedule/')); ?>">Расписание</a>
      <a href="<?php echo esc_url(home_url('/media/')); ?>">Медиа</a>
      <a href="<?php echo esc_url(home_url('/useful/')); ?>">Полезное</a>
      <a href="<?php echo esc_url(home_url('/payment/')); ?>">Оплата</a>
      <a href="<?php echo esc_url(home_url('/contacts/')); ?>">Контакты</a>
    </nav>
    <a class="phone" href="tel:+79856692689">+7 (985) 669-26-89</a>
    <button class="burger" type="button" aria-label="Открыть меню" aria-expanded="false" aria-controls="mobile-navigation"><span></span><span></span><span></span></button><a class="btn btn-p cta" href="<?php echo esc_url(home_url('/#signup')); ?>">Пробная тренировка</a>
  </div>
</header>
<div class="mobile-nav" id="mobile-navigation" aria-hidden="true">
<button class="close" type="button" aria-label="Закрыть меню">✕</button>
<a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
<a href="<?php echo esc_url(home_url('/about/')); ?>">О клубе</a>
<a href="<?php echo esc_url(home_url('/philosophy/')); ?>">Философия</a>
<a href="<?php echo esc_url(home_url('/coaches/')); ?>">Тренеры</a>
<a href="<?php echo esc_url(home_url('/schedule/')); ?>">Расписание</a>
<a href="<?php echo esc_url(home_url('/media/')); ?>">Медиа</a>
<a href="<?php echo esc_url(home_url('/useful/')); ?>">Полезное</a>
<a href="<?php echo esc_url(home_url('/payment/')); ?>">Оплата</a>
<a href="<?php echo esc_url(home_url('/contacts/')); ?>">Контакты</a>
<div class="mcontacts"><a href="tel:+79856692689">+7 (985) 669-26-89</a> · <a href="https://wa.me/79856692689">WhatsApp</a> · <a href="https://t.me/fcsupernovamoscow">Telegram</a></div>
</div>
<main id="content">