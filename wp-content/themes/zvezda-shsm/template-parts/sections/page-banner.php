<?php
$coaches_page = is_page_template('templates/page-coaches.php');
$schedule_page = is_page_template('templates/page-schedule.php');
$media_page = is_page_template('templates/page-media.php');
$useful_page = is_page_template('templates/page-useful.php');
$payment_page = is_page_template('templates/page-payment.php');
$banner_kicker_default = $coaches_page
    ? 'Тренерский штаб'
    : ($schedule_page ? 'Расписание и стоимость' : ($media_page ? 'МЕДИА' : ($useful_page ? 'Полезное' : ($payment_page ? 'Оплата' : ''))));
$banner_title_default = $coaches_page
    ? 'Тренеры Академии'
    : ($schedule_page ? 'Тренировки в СК «Звездка»' : ($media_page ? 'Фото и видео клуба' : ($useful_page ? 'Материалы клуба' : ($payment_page ? 'Оплата и цены занятий' : get_the_title()))));
$banner_description_default = $coaches_page
    ? 'Лицензированные специалисты с опытом работы в сильнейших академиях Москвы и профессиональных клубах. Работу штаба курирует спортивный директор.'
    : ($schedule_page
        ? 'г. Москва, м. Багратионовская, ул. Новозаводская, д. 27А, стр. 1. Поле с искусственной травой последнего поколения, зимой — занятия в зале.'
        : ($media_page
            ? 'Тренировки, матчи и турниры ФК «Супер Нова» — как это выглядит изнутри.'
            : ($useful_page
                ? 'О детском футболе, тренерах и о том, как устроена работа школы. Ниже — хроника клуба: что происходило на поле и вокруг него.'
                : ($payment_page ? 'Оплатить можно картой любого банка' : ''))));

$banner_kicker = zvezda_inner_page_field('page_banner_kicker', $banner_kicker_default);
$banner_title = zvezda_inner_page_field('page_banner_title', $banner_title_default);
$banner_description = zvezda_inner_page_field('page_banner_description', $banner_description_default);
?>
<section class="page-hero">
  <div class="wrap">
    <?php if ($banner_kicker !== '') : ?><div class="kicker"><?php echo esc_html($banner_kicker); ?></div><?php endif; ?>
    <h1><?php echo esc_html($banner_title); ?></h1>
    <?php if ($banner_description !== '') : ?><p><?php echo nl2br(esc_html($banner_description)); ?></p><?php endif; ?>
  </div>
</section>
