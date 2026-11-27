<?php
/**
 * Основные секции главной страницы из docs/main_page.html.
 * Контент статический; ACF будет подключён отдельным этапом.
 */
?>
<?php
$banner_background = zvezda_home_field('banner_background_image');
$banner_background_url = is_array($banner_background) ? ($banner_background['url'] ?? '') : '';
$hero_background_style = $banner_background_url
    ? '--hero-background-image: url("' . esc_url($banner_background_url) . '");'
    : '';
?>
<section class="hero"<?php if ($hero_background_style !== '') : ?> style="<?php echo esc_attr($hero_background_style); ?>"<?php endif; ?>>
  <div class="wrap">
    <div class="badge"><i></i>Сезон 2026/27 · круглогодичный набор детей 5–12 лет</div>
    <h1><?php echo esc_html(zvezda_home_field('banner_title', 'Академия')); ?> <span style="white-space:nowrap"><?php echo esc_html(zvezda_setting('club_name')); ?></span> — <em><?php echo esc_html(zvezda_home_field('banner_subtitle', 'совершенствуйся играя')); ?></em></h1>
    <p class="lead"><?php echo nl2br(esc_html(zvezda_home_field('banner_description', 'Играй. Общайся. Расти. Развивайся. Тренеры с лицензиями UEFA, единая методика подготовки и соревнования Московской Федерации Футбола.'))); ?></p>
    <div class="actions">
      <a class="btn btn-hero" href="<?php echo esc_url(home_url('/#signup')); ?>">Записаться на пробную тренировку</a>
      <a class="btn btn-ghost" href="https://wa.me/<?php echo esc_attr(zvezda_phone_digits()); ?>">Написать в WhatsApp</a>
    </div>
    <div class="facts">
      <div><b><?php echo esc_html(zvezda_home_field('banner_fact_1_value', 'A / B / C')); ?></b><?php echo esc_html(zvezda_home_field('banner_fact_1_text', 'лицензии UEFA у тренеров')); ?></div>
      <div><b><?php echo esc_html(zvezda_home_field('banner_fact_2_value', 'СК «Фили»')); ?></b><?php echo esc_html(zvezda_home_field('banner_fact_2_text', 'м. Багратионовская')); ?></div>
      <div><b><?php echo esc_html(zvezda_home_field('banner_fact_3_value', '0 ₽')); ?></b><?php echo esc_html(zvezda_home_field('banner_fact_3_text', 'первая тренировка')); ?></div>
    </div>
  </div>
</section>


<div class="stats">
  <div class="wrap reveal on">
<?php for ($i = 1; $i <= 4; $i++) : ?>
    <div class="stat"><b><?php echo esc_html(zvezda_home_field("stat_{$i}_value", ['', '1000+', 'с 2000 г.', '5–12 лет', '2 раза в год'][$i])); ?></b><span><?php echo esc_html(zvezda_home_field("stat_{$i}_text", ['', 'детей в сообществе Super Nova', 'работает международное сообщество', 'возраст учеников школы', 'футбольное тестирование игроков'][$i])); ?></span></div>
<?php endfor; ?>
  </div>
</div>


<section class="section age" id="club">
  <div class="wrap reveal on">
    <div class="kicker"><?php echo esc_html(zvezda_home_field('age_kicker', 'Кого мы ждём')); ?></div>
    <h2><?php echo esc_html(zvezda_home_field('age_title', 'Возрастные группы набора')); ?></h2>
    <p class="sub" style="margin-bottom:32px"><?php echo esc_html(zvezda_home_field('age_subtitle', 'Круглогодичный набор юных футболистов. Группы формируются по годам рождения, программа адаптирована под возраст.')); ?></p>
    <div class="grid g4">
<?php for ($i = 1; $i <= 4; $i++) : $default_years = ['', '5–6', '7–8', '9–10', '11–12'][$i]; $default_texts = ['', 'Первые шаги в футболе: игра, координация, любовь к мячу', 'Базовая техника, работа с мячом, командные игры', 'Техника, тактические основы, товарищеские матчи', 'Соревнования МФФ, тестирование, подготовка к академиям'][$i]; ?>
      <div class="card"><span class="num"><?php echo esc_html(zvezda_home_field("age_{$i}_years", $default_years)); ?></span><b><?php echo esc_html(zvezda_home_field("age_{$i}_years", $default_years)); ?> лет</b><span><?php echo esc_html(zvezda_home_field("age_{$i}_text", $default_texts)); ?></span></div>
<?php endfor; ?>
    </div>
  </div>
</section>


<section class="section adv">
  <div class="wrap reveal">
    <div class="kicker"><?php echo esc_html(zvezda_home_field('benefits_kicker', 'Почему ' . zvezda_setting('club_name'))); ?></div>
    <h2><?php echo esc_html(zvezda_home_field('benefits_title', 'Что получает ваш ребёнок')); ?></h2>
    <p class="sub" style="margin-bottom:32px"><?php echo esc_html(zvezda_home_field('benefits_subtitle', 'В центре философии клуба — игрок. Главная задача школы — обучение и развитие игрока.')); ?></p>
    <div class="grid g2">
<?php
$benefit_icon_defaults = [
'',
];
for ($i = 1; $i <= 6; $i++) :
$icon = zvezda_home_field("benefit_{$i}_icon", '');
?>
      <div class="card"><div class="ico"><?php echo wp_kses($icon, ['svg' => ['width'=>true,'height'=>true,'viewBox'=>true,'fill'=>true,'stroke'=>true,'stroke-width'=>true,'stroke-linecap'=>true,'stroke-linejoin'=>true], 'path' => ['d'=>true], 'rect' => ['x'=>true,'y'=>true,'width'=>true,'height'=>true,'rx'=>true], 'circle' => ['cx'=>true,'cy'=>true,'r'=>true], 'line' => ['x1'=>true,'y1'=>true,'x2'=>true,'y2'=>true]]); ?></div><div><h3><?php echo esc_html(zvezda_home_field("benefit_{$i}_title", '')); ?></h3><p><?php echo esc_html(zvezda_home_field("benefit_{$i}_text", '')); ?></p></div></div>
<?php endfor; ?>
    </div>
  </div>
</section>


<section class="section" id="coaches" style="background:var(--bg-soft)">
  <div class="wrap reveal">
    <div class="kicker">Тренерский штаб</div>
    <h2>Тренеры Академии</h2>
    <p class="sub" style="margin-bottom:32px">Тренировочный процесс курирует спортивный директор, тренеры работают по единой методике клуба.</p>
    <?php
    $home_coaches = new WP_Query([
        'post_type' => 'coach',
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'meta_key' => 'coach_show_on_home',
        'meta_value' => '1',
        'orderby' => ['menu_order' => 'ASC', 'date' => 'ASC'],
        'no_found_rows' => true,
    ]);
    ?>
    <?php if ($home_coaches->have_posts()) : ?>
      <div class="grid g2">
        <?php while ($home_coaches->have_posts()) : $home_coaches->the_post();
          $coach_id = get_the_ID();
          $coach_name = function_exists('get_field') ? get_field('coach_full_name', $coach_id) : '';
          $coach_titles = get_post_meta($coach_id, '_coach_titles_list', true);
          if (!is_array($coach_titles) || !$coach_titles) {
            $legacy_titles = function_exists('get_field') ? get_field('coach_titles', $coach_id) : '';
            $coach_titles = $legacy_titles ? preg_split('/\s*·\s*|\r?\n/', $legacy_titles) : [];
          }
          $coach_titles = array_filter(array_map('trim', $coach_titles));
          $coach_titles_text = implode(' · ', $coach_titles);
          $coach_description = function_exists('get_field') ? get_field('coach_description', $coach_id) : '';
          $coach_experience = function_exists('get_field') ? get_field('coach_experience', $coach_id) : '';
          $coach_image = get_the_post_thumbnail_url($coach_id, 'large');
        ?>
          <article class="coach2">
            <?php if ($coach_image) : ?>
              <img src="<?php echo esc_url($coach_image); ?>" alt="<?php echo esc_attr($coach_name ?: get_the_title()); ?>" loading="lazy">
            <?php endif; ?>
            <div>
              <h3><?php echo esc_html($coach_name ?: get_the_title()); ?></h3>
              <?php if ($coach_titles_text) : ?><div class="role"><?php echo esc_html($coach_titles_text); ?></div><?php endif; ?>
              <?php if ($coach_description) : ?><p><?php echo nl2br(esc_html($coach_description)); ?></p><?php endif; ?>
              <?php if ($coach_experience) : ?><p>Опыт: <?php echo nl2br(esc_html($coach_experience)); ?></p><?php endif; ?>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
    <p class="coaches-more">Полный тренерский штаб — на странице <a href="<?php echo esc_url(home_url('/coaches/')); ?>">«Тренеры»</a>.</p>
  </div>
</section>


<section class="section gallery-section" style="background:var(--bg-soft)">
  <div class="wrap reveal">
    <?php
    $gallery_items = [];
    for ($gallery_index = 1; $gallery_index <= 3; $gallery_index++) {
        $gallery_image = zvezda_home_field("gallery_image_{$gallery_index}");
        if (!$gallery_image || !is_array($gallery_image) || empty($gallery_image['url'])) {
            continue;
        }

        $gallery_alt = zvezda_home_field("gallery_image_{$gallery_index}_alt");
        if ($gallery_alt === '') {
            $gallery_alt = $gallery_image['alt'] ?? '';
        }

        $gallery_items[] = [
            'ID' => !empty($gallery_image['ID']) ? absint($gallery_image['ID']) : 0,
            'url' => $gallery_image['url'],
            'alt' => $gallery_alt,
        ];
    }
    ?>
    <?php if ($gallery_items) : ?>
    <div class="gallery" aria-label="Фотогалерея клуба">
      <?php foreach ($gallery_items as $gallery_index => $gallery_item) :
        $gallery_image_id = !empty($gallery_item['ID']) ? absint($gallery_item['ID']) : 0;
        $gallery_full_url = $gallery_image_id
            ? wp_get_attachment_image_url($gallery_image_id, 'full')
            : $gallery_item['url'];
      ?>
        <a
          class="gallery-item fancybox"
          href="<?php echo esc_url($gallery_full_url ?: $gallery_item['url']); ?>"
          rel="home-gallery"
          aria-label="<?php echo esc_attr($gallery_item['alt'] ?: 'Открыть фотографию ' . ($gallery_index + 1)); ?>"
        >
          <?php if ($gallery_image_id) : ?>
            <?php echo wp_get_attachment_image($gallery_image_id, 'large', false, [
                'alt' => $gallery_item['alt'],
                'loading' => 'lazy',
                'decoding' => 'async',
            ]); ?>
          <?php else : ?>
            <img src="<?php echo esc_url($gallery_item['url']); ?>" alt="<?php echo esc_attr($gallery_item['alt']); ?>" loading="lazy" decoding="async">
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>


<?php
$schedule_title = zvezda_home_field('schedule_title', 'Тренировки в СК «Фили»');
$schedule_subtitle = zvezda_home_field('schedule_subtitle', 'Поле с искусственной травой последнего поколения, зимой — занятия в зале.');
$schedule_days_title = zvezda_home_field('schedule_days_title', 'Расписание · сезон 2026/27');
$schedule_footer = zvezda_home_field('schedule_footer', 'Время указано по действующему расписанию — перед стартом сезона уточняется для каждой возрастной группы.');
$membership_title = zvezda_home_field('membership_title', 'Что входит в абонемент');
$page_id = (int) get_queried_object_id();
$get_editable_text = function ($field_name, $default = '') use ($page_id) {
    if (function_exists('get_field') && $page_id && metadata_exists('post', $page_id, $field_name)) {
        $value = get_field($field_name, $page_id);
        return $value === null || $value === false ? '' : $value;
    }
    return $default;
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
        <a class="btn btn-hero" href="<?php echo esc_url(home_url('/#signup')); ?>" style="width:100%">Записаться бесплатно</a>
      </div>
    </div>
    <div class="grid g3" style="margin-top:20px">
      <?php
      $tariff_defaults = [
          ['5 000 ₽', '1 тренировка в неделю', 'Мягкий старт: для самых маленьких и для совмещения с другими секциями.'],
          ['7 000 ₽', '2 тренировки в неделю', 'Стабильный ритм: техника и игровая практика каждую неделю.'],
          ['9 500 ₽', '3 тренировки в неделю', 'Максимальный прогресс: полный тренировочный цикл плюс игровые дни.'],
      ];
      for ($i = 1; $i <= 3; $i++) :
          $tariff_price = zvezda_home_field("tariff_{$i}_price", $tariff_defaults[$i - 1][0]);
          $tariff_per = zvezda_home_field("tariff_{$i}_per", $tariff_defaults[$i - 1][1]);
          $tariff_description = zvezda_home_field("tariff_{$i}_description", $tariff_defaults[$i - 1][2]);
      ?>
        <div class="card tariff<?php echo $i === 3 ? ' hl' : ''; ?>">
          <?php if ($i === 3) : ?><div class="tag">Полная программа</div><?php endif; ?>
          <div class="num"><?php echo esc_html($tariff_price); ?><small>/мес</small></div>
          <div class="per"><?php echo esc_html($tariff_per); ?></div>
          <p><?php echo esc_html($tariff_description); ?></p>
          <?php if ($i === 3) : ?>
            <a class="btn btn-hero" href="<?php echo esc_url(home_url('/#signup')); ?>" style="width:100%;margin-top:14px">Выбрать</a>
          <?php endif; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>


<?php
$video_title = zvezda_home_field('video_title', 'Смотрите матчи клуба');
$video_subtitle = zvezda_home_field('video_subtitle', 'Записи матчей и трансляции — на YouTube-канале ' . zvezda_setting('club_name') . ' ТВ.');
$video_url = zvezda_home_field('video_url', '');
$video_preview = zvezda_home_field('video_preview_image', []);
$video_preview_url = is_array($video_preview) && !empty($video_preview['url'])
    ? $video_preview['url']
    : get_theme_file_uri('/assets/images/maxresdefault.jpg');
?>
<section class="section video-sec">
  <div class="wrap reveal">
    <div class="kicker">Видео</div>
    <h2><?php echo esc_html($video_title); ?></h2>
    <p class="sub" style="margin-bottom:28px"><?php echo esc_html($video_subtitle); ?></p>
    <div
      class="video-card<?php echo $video_url ? ' is-playable' : ''; ?>"
      id="videoCard"
      <?php if ($video_url) : ?>role="button" tabindex="0" data-video-url="<?php echo esc_url($video_url); ?>" aria-label="Смотреть видео матча"<?php endif; ?>
    >
      <img src="<?php echo esc_url($video_preview_url); ?>" alt="<?php echo esc_attr($video_title); ?>" loading="lazy">
      <?php if ($video_url) : ?>
        <div class="play"><svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5z"></path></svg></div>
        <div class="vtitle">Смотреть видео</div>
      <?php endif; ?>
    </div>
    <div style="text-align:center;margin-top:26px">
      <a class="btn btn-ghost" href="<?php echo esc_url(zvezda_setting('youtube_url')); ?>" target="_blank" rel="noopener">Все видео на YouTube</a>
    </div>
  </div>
</section>


<section class="section rev">
  <div class="wrap reveal">
    <div class="kicker">Отзывы</div>
    <h2>Что говорят родители</h2>
    <div class="yrating"><span class="stars">★★★★★</span> 4,4 на Яндекс.Картах · 23 оценки · <a href="<?php echo esc_url(zvezda_setting('yandex_reviews_url')); ?>" target="_blank" rel="noopener">читать все</a></div>
    <div class="grid g3">
      <?php
      $home_reviews = new WP_Query([
          'post_type' => 'review',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'orderby' => ['menu_order' => 'ASC', 'date' => 'ASC'],
          'no_found_rows' => true,
      ]);
      ?>
      <?php if ($home_reviews->have_posts()) : while ($home_reviews->have_posts()) : $home_reviews->the_post();
          $review_id = get_the_ID();
          $review_text = function_exists('get_field') ? get_field('review_text', $review_id) : get_post_meta($review_id, 'review_text', true);
          $review_author = function_exists('get_field') ? get_field('review_author', $review_id) : get_post_meta($review_id, 'review_author', true);
          $review_source = function_exists('get_field') ? get_field('review_source', $review_id) : get_post_meta($review_id, 'review_source', true);
          $review_date = function_exists('get_field') ? get_field('review_date', $review_id) : get_post_meta($review_id, 'review_date', true);
          if (!$review_text) continue;
      ?>
        <div class="card">
          <p><?php echo nl2br(esc_html($review_text)); ?></p>
          <b><?php echo esc_html($review_author ?: get_the_title()); ?></b>
          <?php if ($review_source) : ?><span class="rdate"><?php echo esc_html($review_source); ?></span><?php endif; ?>
          <?php if ($review_date) : ?><span class="rdate"><?php echo esc_html($review_date); ?></span><?php endif; ?>
        </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </div>
</section>


<section class="section faq" id="faq">
  <div class="wrap reveal" style="max-width:840px">
    <div class="kicker">Вопросы и ответы</div>
    <h2>Частые вопросы родителей</h2>
    <div class="faq-list" style="margin-top:20px">
      <?php
      $home_faq = new WP_Query([
          'post_type' => 'faq',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'orderby' => ['menu_order' => 'ASC', 'date' => 'ASC'],
          'no_found_rows' => true,
      ]);
      ?>
      <?php if ($home_faq->have_posts()) : ?>
        <?php $faq_index = 0; while ($home_faq->have_posts()) : $home_faq->the_post();
          $faq_answer = function_exists('get_field') ? get_field('faq_answer', get_the_ID()) : get_post_meta(get_the_ID(), 'faq_answer', true);
          if (!$faq_answer) continue;
        ?>
          <details<?php echo $faq_index === 0 ? ' open' : ''; ?>>
            <summary><?php the_title(); ?></summary>
            <div class="a"><?php echo nl2br(esc_html($faq_answer)); ?></div>
          </details>
        <?php $faq_index++; endwhile; wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>
</section>


<section class="section steps-section" style="background:var(--bg-soft)">
  <div class="wrap reveal">
    <div class="kicker">Три простых шага</div>
    <h2>Как записаться</h2>
    <div class="steps" style="margin-top:28px">
      <div class="step"><div class="n">1</div><h3>Оставьте заявку</h3><p>Через форму ниже, по телефону или в WhatsApp — как удобнее.</p></div>
      <div class="step"><div class="n">2</div><h3>Мы перезвоним</h3><p>Подберём группу по возрасту и удобные дни тренировок.</p></div>
      <div class="step"><div class="n">3</div><h3>Приходите на тренировку</h3><p>Первое занятие бесплатно. Спортивная форма и обувь по погоде, приезжайте за 15 минут.</p></div>
    </div>
  </div>
</section>


<?php
$signup_photo = zvezda_home_field('signup_photo', []);
$signup_photo_url = is_array($signup_photo) && !empty($signup_photo['url'])
    ? $signup_photo['url']
    : get_theme_file_uri('/assets/images/boys.jpg');
$signup_photo_alt = zvezda_home_field('signup_photo_alt', '');
if ($signup_photo_alt === '') {
    $signup_photo_alt = is_array($signup_photo) && !empty($signup_photo['alt'])
        ? $signup_photo['alt']
        : 'Юные игроки ' . zvezda_setting('club_name');
}
?>
<section class="section signup" id="signup">
  <div class="wrap inner reveal">
    <div>
      <div class="kicker">Запись</div>
      <h2><?php echo esc_html(zvezda_home_field('signup_title', 'Первая тренировка — бесплатно')); ?></h2>
      <p><?php echo nl2br(esc_html(zvezda_home_field('signup_description', 'Оставьте заявку — перезвоним, подберём группу по возрасту и пригласим на пробное занятие. Или напишите нам в мессенджер, так быстрее.'))); ?></p>
      <div class="mess">
        <a class="btn" href="https://wa.me/<?php echo esc_attr(zvezda_phone_digits()); ?>">WhatsApp</a>
        <a class="btn" href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>">Telegram</a>
      </div>
      <img class="photo" src="<?php echo esc_url($signup_photo_url); ?>" alt="<?php echo esc_attr($signup_photo_alt); ?>" loading="lazy">
    </div>
    <div class="form" style="box-shadow:0 20px 50px -30px rgba(20,24,56,.35)">
      <h3>Записаться на пробную тренировку</h3>
      <label for="signup-child">ФИО ребёнка</label><input id="signup-child" type="text" placeholder="Имя и фамилия">
      <label for="signup-email">E-mail</label><input id="signup-email" type="email" placeholder="you@example.com">
      <label for="signup-phone">Телефон</label><input id="signup-phone" type="tel" placeholder="+7 (___) ___-__-__">
      <label for="signup-birth">Дата рождения ребёнка</label><input id="signup-birth" type="text" placeholder="дд.мм.гггг">
      <label for="signup-parent">ФИО одного из родителей</label><input id="signup-parent" type="text">
      <label for="signup-extra">Дополнительная информация</label><textarea id="signup-extra" rows="3"></textarea>
      <button class="btn btn-p" type="button" disabled>Отправка будет подключена позже</button>
      <p class="form-note">Форма пока демонстрационная и не отправляет данные.</p>
    </div>
  </div>
</section>


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
