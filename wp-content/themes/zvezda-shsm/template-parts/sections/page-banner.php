<?php
$banner_kicker = zvezda_inner_page_field('page_banner_kicker', '');
$banner_title = zvezda_inner_page_field('page_banner_title', get_the_title());
$banner_description = zvezda_inner_page_field('page_banner_description', '');
?>
<section class="page-hero">
  <div class="wrap">
    <?php if ($banner_kicker !== '') : ?><div class="kicker"><?php echo esc_html($banner_kicker); ?></div><?php endif; ?>
    <h1><?php echo esc_html($banner_title); ?></h1>
    <?php if ($banner_description !== '') : ?><p><?php echo nl2br(esc_html($banner_description)); ?></p><?php endif; ?>
  </div>
</section>
