<?php
$schedule_title = zvezda_front_page_field('schedule_title', 'Тренировки в СК «Фили»');
$schedule_subtitle = zvezda_front_page_field('schedule_subtitle', 'Поле с искусственной травой последнего поколения, зимой — занятия в зале.');
$schedule_days_title = zvezda_front_page_field('schedule_days_title', 'Расписание · сезон 2026/27');
$schedule_footer = zvezda_front_page_field('schedule_footer', 'Время указано по действующему расписанию — перед стартом сезона уточняется для каждой возрастной группы.');
$membership_title = zvezda_front_page_field('membership_title', 'Что входит в абонемент');
$get_editable_text = function ($field_name, $default = '') {
    return zvezda_front_page_field($field_name, $default);
};
$schedule_slots = [
    ['label' => 'Понедельник', 'value' => $get_editable_text('schedule_monday', '')],
    ['label' => 'Вторник', 'value' => $get_editable_text('schedule_tuesday', '19:00 — 20:15')],
    ['label' => 'Среда', 'value' => $get_editable_text('schedule_wednesday', '')],
    ['label' => 'Четверг', 'value' => $get_editable_text('schedule_thursday', '19:00 — 20:15')],
    ['label' => 'Пятница', 'value' => $get_editable_text('schedule_friday', '')],
    ['label' => 'Суббота', 'value' => $get_editable_text('schedule_saturday', '')],
    ['label' => 'Воскресенье', 'value' => $get_editable_text('schedule_sunday', '15:00 — 16:15')],
    ['label' => 'Суббота / Воскресенье', 'value' => $get_editable_text('schedule_weekend', 'игровые дни')],
];
$membership_items = [];
for ($i = 1; $i <= 6; $i++) {
    $membership_items[] = $get_editable_text("membership_item_{$i}", [
        1 => 'Первая пробная тренировка — бесплатно',
        2 => 'Тренеры с лицензиями UEFA',
        3 => 'Тестирование игроков 2 раза в год',
        4 => 'Личный кабинет родителя в ProTrainUp',
        5 => 'Централизованный медосмотр',
        6 => 'Игровые дни по выходным',
    ][$i]);
}
?>
<section class="section sched" id="schedule" style="background:#fff">
  <div class="wrap reveal">
    <div class="kicker">Расписание и стоимость</div>
    <h2><?php echo esc_html($schedule_title); ?></h2>
    <p class="sub" style="margin-bottom:32px"><?php echo esc_html(zvezda_setting('address')); ?>. <?php echo esc_html($schedule_subtitle); ?></p>
    <div class="grid g2">
      <div class="card">
        <h3><?php echo esc_html($schedule_days_title); ?></h3>
        <table>
          <tbody>
            <?php foreach ($schedule_slots as $schedule_slot) :
              if (trim((string) $schedule_slot['value']) === '') continue;
            ?>
              <tr><td><?php echo esc_html($schedule_slot['label']); ?></td><td><?php echo esc_html($schedule_slot['value']); ?></td></tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php if ($schedule_footer !== '') : ?><p class="note" style="margin-top:14px"><?php echo nl2br(esc_html($schedule_footer)); ?></p><?php endif; ?>
      </div>
      <div class="card price">
        <h3><?php echo esc_html($membership_title); ?></h3>
        <ul>
          <?php foreach ($membership_items as $membership_text) :
            if (trim((string) $membership_text) === '') continue;
          ?>
            <li><?php echo esc_html($membership_text); ?></li>
          <?php endforeach; ?>
        </ul>
        <a class="btn btn-hero" href="<?php echo esc_url('#signup'); ?>" style="width:100%">Записаться бесплатно</a>
      </div>
    </div>
    <?php get_template_part('template-parts/sections/tariffs'); ?>
  </div>
</section>


