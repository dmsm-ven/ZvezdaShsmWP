<?php
/**
 * Shared tariff cards used on the homepage schedule section and Payment page.
 */
$tariff_defaults = [
    ['5 000 ₽', '1 тренировка в неделю', 'Мягкий старт: для самых маленьких и для совмещения с другими секциями.'],
    ['7 000 ₽', '2 тренировки в неделю', 'Стабильный ритм: техника и игровая практика каждую неделю.'],
    ['9 500 ₽', '3 тренировки в неделю', 'Максимальный прогресс: полный тренировочный цикл плюс игровые дни.'],
];
?>
<div class="grid g3 payment-tariffs-grid" style="margin-top:20px">
  <?php for ($i = 1; $i <= 3; $i++) :
      $tariff_price = zvezda_front_page_field("tariff_{$i}_price", $tariff_defaults[$i - 1][0]);
      $tariff_per = zvezda_front_page_field("tariff_{$i}_per", $tariff_defaults[$i - 1][1]);
      $tariff_description = zvezda_front_page_field("tariff_{$i}_description", $tariff_defaults[$i - 1][2]);
  ?>
    <div class="card tariff<?php echo $i === 3 ? ' hl' : ''; ?>">
      <?php if ($i === 3) : ?><div class="tag">Полная программа</div><?php endif; ?>
      <div class="num"><?php echo esc_html($tariff_price); ?><small>/мес</small></div>
      <div class="per"><?php echo esc_html($tariff_per); ?></div>
      <p><?php echo esc_html($tariff_description); ?></p>
      <?php if ($i === 3) : ?>
        <a class="btn btn-hero" href="<?php echo esc_url('#signup'); ?>" style="width:100%;margin-top:14px">Выбрать</a>
      <?php endif; ?>
    </div>
  <?php endfor; ?>
</div>
