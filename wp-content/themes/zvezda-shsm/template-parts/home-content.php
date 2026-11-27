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


<section class="section" style="padding-top:0;background:var(--bg-soft)">
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
          class="gallery-item"
          href="<?php echo esc_url($gallery_full_url ?: $gallery_item['url']); ?>"
          rel="lightbox[home-gallery]"
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


<section class="section sched" id="schedule" style="background:#fff">
  <div class="wrap reveal">
    <div class="kicker">Расписание и стоимость</div>
    <h2>Тренировки в СК «Фили»</h2>
    <p class="sub" style="margin-bottom:32px"><?php echo esc_html(zvezda_setting('address')); ?>. Поле с искусственной травой последнего поколения, зимой — занятия в зале.</p>
    <div class="grid g2">
      <div class="card">
        <h3>Расписание · сезон 2026/27</h3>
        <table>
          <tbody><tr><td>Вторник</td><td>19:00 — 20:15</td></tr>
          <tr><td>Четверг</td><td>19:00 — 20:15</td></tr>
          <tr><td>Воскресенье</td><td>15:00 — 16:15</td></tr>
          <tr><td>Суббота / воскресенье</td><td>игровые дни</td></tr>
        </tbody></table>
        <p class="note" style="margin-top:14px">Время указано по действующему расписанию — перед стартом сезона уточняется для каждой возрастной группы.</p>
      </div>
      <div class="card price">
        <h3>Что входит в абонемент</h3>
        <ul>
          <li>Первая пробная тренировка — бесплатно</li>
          <li>Тренеры с лицензиями UEFA</li>
          <li>Тестирование игроков 2 раза в год</li>
          <li>Личный кабинет родителя в ProTrainUp</li>
          <li>Централизованный медосмотр</li>
          <li>Игровые дни по выходным</li>
        </ul>
        <a class="btn btn-hero" href="<?php echo esc_url(home_url('/#signup')); ?>" style="width:100%">Записаться бесплатно</a>
      </div>
    </div>
    <div class="grid g3" style="margin-top:20px">
      <div class="card tariff">
        <div class="num">5 000 ₽<small>/мес</small></div>
        <div class="per">1 тренировка в неделю</div>
        <p>Мягкий старт: для самых маленьких и для совмещения с другими секциями.</p>
      </div>
      <div class="card tariff">
        <div class="num">7 000 ₽<small>/мес</small></div>
        <div class="per">2 тренировки в неделю</div>
        <p>Стабильный ритм: техника и игровая практика каждую неделю.</p>
      </div>
      <div class="card tariff hl">
        <div class="tag">Полная программа</div>
        <div class="num">9 500 ₽<small>/мес</small></div>
        <div class="per">3 тренировки в неделю</div>
        <p>Максимальный прогресс: полный тренировочный цикл плюс игровые дни.</p>
        <a class="btn btn-hero" href="<?php echo esc_url(home_url('/#signup')); ?>" style="width:100%;margin-top:14px">Выбрать</a>
      </div>
    </div>
  </div>
</section>


<section class="section video-sec">
  <div class="wrap reveal">
    <div class="kicker">Видео</div>
    <h2>Смотрите матчи клуба</h2>
    <p class="sub" style="margin-bottom:28px">Записи матчей и трансляции — на YouTube-канале <?php echo esc_html(zvezda_setting('club_name')); ?> ТВ.</p>
    <div class="video-card" id="videoCard" role="button" tabindex="0" aria-label="Смотреть видео матча">
      <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/maxresdefault.jpg')); ?>" alt="<?php echo esc_attr('Матч ' . zvezda_setting('club_name') . ' — ФК Герион'); ?>" loading="lazy">
      <div class="play"><svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5z"></path></svg></div>
      <div class="vtitle">AFL Kids · Матч за 3-е место · <?php echo esc_html(zvezda_setting('club_name')); ?> — Герион 3:0</div>
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
    <div class="yrating"><span class="stars">★★★★★</span> 4,4 на Яндекс.Картах · 23 оценки · <a href="https://yandex.com/maps/org/fc_super_nova_moscow/155444875307/reviews/" target="_blank" rel="noopener">читать все</a></div>
    <div class="grid g3">
      <div class="card"><p>Хорошая спортивная школа, тренера все опытные, дети многому научатся, посещая данную школу. Советую всем!</p><b>Яна К.</b><span class="rdate">Отзыв с Яндекс.Карт</span></div>
      <div class="card"><p>Хорошая школа для будущих спортсменов. Сын занимается с большим удовольствием.</p><b>Александр Баджурак</b><span class="rdate">Отзыв с Яндекс.Карт</span></div>
      <div class="card"><p>Ребёнку нравится, ходим 3 раза в неделю.</p><b>Галина Хорошуненко</b><span class="rdate">Отзыв с Яндекс.Карт</span></div>
    </div>
  </div>
</section>


<section class="section faq" id="faq" style="padding-top:0">
  <div class="wrap reveal" style="max-width:840px">
    <div class="kicker">Вопросы и ответы</div>
    <h2>Частые вопросы родителей</h2>
    <div style="margin-top:20px">
      <details open="">
        <summary>Сколько стоит обучение?</summary>
        <div class="a">Месячный абонемент: 9 500 ₽ — 3 тренировки в неделю, 7 000 ₽ — 2 тренировки, 5 000 ₽ — 1 тренировка. Первая пробная тренировка бесплатна для всех.</div>
      </details>
      <details>
        <summary>Детей какого возраста вы принимаете?</summary>
        <div class="a">Принимаем детей 5–12 лет. Набор в школу проходит круглый год, группы формируются по возрасту.</div>
      </details>
      <details>
        <summary>Что взять с собой на пробную тренировку?</summary>
        <div class="a">Спортивную форму и обувь по погоде. Приезжайте за 15 минут до начала занятия. Записаться можно через форму на сайте или по телефону <?php echo esc_html(zvezda_setting('phone')); ?>.</div>
      </details>
      <details>
        <summary>Нужна ли медицинская справка?</summary>
        <div class="a">Клуб организует централизованное прохождение медосмотра в физкультурном диспансере — самостоятельно оформлять справку о допуске не нужно.</div>
      </details>
      <details>
        <summary>Где и когда проходят тренировки?</summary>
        <div class="a">В спортивном комплексе «Фили» (<?php echo esc_html(zvezda_setting('address')); ?>): вторник и четверг 19:00–20:15, воскресенье 15:00–16:15. Зимой занятия проходят в зале и на поле с искусственной травой. Выходные — игровые дни.</div>
      </details>
      <details>
        <summary>Как следить за прогрессом ребёнка?</summary>
        <div class="a">У каждого родителя есть личный кабинет в системе ProTrainUp: посещаемость, статистика тренировок и матчей, расписание, оплата абонемента и связь с тренером — всё в мобильном приложении.</div>
      </details>
      <details>
        <summary>Участвуют ли команды в соревнованиях?</summary>
        <div class="a">Да, команды клуба регулярно играют в соревнованиях Московской Федерации Футбола в разных возрастных категориях, проводят товарищеские матчи и выезжают на турниры и сборы, включая международные.</div>
      </details>
    </div>
  </div>
</section>


<section class="section" style="background:var(--bg-soft)">
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


<section class="section signup" id="signup">
  <div class="wrap inner reveal">
    <div>
      <div class="kicker">Запись</div>
      <h2>Первая тренировка — бесплатно</h2>
      <p>Оставьте заявку — перезвоним, подберём группу по возрасту и пригласим на пробное занятие. Или напишите нам в мессенджер, так быстрее.</p>
      <div class="mess">
        <a class="btn" href="https://wa.me/<?php echo esc_attr(zvezda_phone_digits()); ?>">WhatsApp</a>
        <a class="btn" href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>">Telegram</a>
      </div>
      <img class="photo" src="<?php echo esc_url(get_theme_file_uri('/assets/images/boys.jpg')); ?>" alt="<?php echo esc_attr('Юные игроки ' . zvezda_setting('club_name')); ?>" loading="lazy">
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


<section class="section contacts" id="contacts">
  <div class="wrap reveal">
    <div class="kicker">Контакты</div>
    <h2>Как нас найти</h2>
    <div class="grid g2" style="margin-top:28px">
      <div class="card">
        <p><b>Адрес:</b> <?php echo esc_html(zvezda_setting('address')); ?></p>
        <p><b>Телефон:</b> <a href="<?php echo esc_url('tel:' . zvezda_phone_href()); ?>"><?php echo esc_html(zvezda_setting('phone')); ?></a></p>
        <p><b>E-mail:</b> <a href="<?php echo esc_url('mailto:' . zvezda_setting('email')); ?>"><?php echo esc_html(zvezda_setting('email')); ?></a></p>
        <p><b>Мессенджеры:</b> <a href="https://wa.me/<?php echo esc_attr(zvezda_phone_digits()); ?>">WhatsApp</a> · <a href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>">Telegram</a></p>
        <p><b>Соцсети:</b> <a href="<?php echo esc_url(zvezda_setting('vk_url')); ?>">VK</a> · <a href="<?php echo esc_url(zvezda_setting('youtube_url')); ?>">YouTube</a> </p>
      </div>
      
    </div>
  </div>
</section>
