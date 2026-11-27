<?php
$coaches_page = is_page_template('templates/page-coaches.php');
$banner_kicker_default = $coaches_page ? 'Тренерский штаб' : '';
$banner_title_default = $coaches_page ? 'Тренеры Академии' : get_the_title();
$banner_description_default = $coaches_page
    ? 'Лицензированные специалисты с опытом работы в сильнейших академиях Москвы и профессиональных клубах. Работу штаба курирует спортивный директор.'
    : '';

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
