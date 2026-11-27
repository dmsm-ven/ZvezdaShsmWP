<?php
/**
 * Основные секции главной страницы из docs/main_page.html.
 * Контент статический; ACF будет подключён отдельным этапом.
 */
?>
<section class="hero">
  <div class="wrap">
    <div class="badge"><i></i>Сезон 2026/27 · круглогодичный набор детей 5–12 лет</div>
    <h1>Академия <span style="white-space:nowrap"><?php echo esc_html(zvezda_setting('club_name')); ?></span> — <em>совершенствуйся играя</em></h1>
    <p class="lead">Играй. Общайся. Расти. Развивайся. Тренеры с лицензиями UEFA, единая методика подготовки и соревнования Московской Федерации Футбола.</p>
    <div class="actions">
      <a class="btn btn-hero" href="<?php echo esc_url(home_url('/#signup')); ?>">Записаться на пробную тренировку</a>
      <a class="btn btn-ghost" href="https://wa.me/79856692689">Написать в WhatsApp</a>
    </div>
    <div class="facts">
      <div><b>A / B / C</b>лицензии UEFA у тренеров</div>
      <div><b>СК «Фили»</b>м. Багратионовская</div>
      <div><b>0 ₽</b>первая тренировка</div>
    </div>
  </div>
</section>


<div class="stats">
  <div class="wrap reveal on">
    <div class="stat"><b>1000+</b><span>детей в сообществе Super Nova</span></div>
    <div class="stat"><b>с 2000 г.</b><span>работает международное сообщество</span></div>
    <div class="stat"><b>5–12 лет</b><span>возраст учеников школы</span></div>
    <div class="stat"><b>2 раза в год</b><span>футбольное тестирование игроков</span></div>
  </div>
</div>


<section class="section age" id="club">
  <div class="wrap reveal on">
    <div class="kicker">Кого мы ждём</div>
    <h2>Возрастные группы набора</h2>
    <p class="sub" style="margin-bottom:32px">Круглогодичный набор юных футболистов. Группы формируются по годам рождения, программа адаптирована под возраст.</p>
    <div class="grid g4">
      <div class="card"><span class="num">5–6</span><b>5–6 лет</b><span>Первые шаги в футболе: игра, координация, любовь к мячу</span></div>
      <div class="card"><span class="num">7–8</span><b>7–8 лет</b><span>Базовая техника, работа с мячом, командные игры</span></div>
      <div class="card"><span class="num">9–10</span><b>9–10 лет</b><span>Техника, тактические основы, товарищеские матчи</span></div>
      <div class="card"><span class="num">11–12</span><b>11–12 лет</b><span>Соревнования МФФ, тестирование, подготовка к академиям</span></div>
    </div>
  </div>
</section>


<section class="section adv">
  <div class="wrap reveal">
    <div class="kicker">Почему «Супер Нова»</div>
    <h2>Что получает ваш ребёнок</h2>
    <p class="sub" style="margin-bottom:32px">В центре философии клуба — игрок. Главная задача школы — обучение и развитие игрока.</p>
    <div class="grid g2">
      <div class="card"><div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.6-3 8.2-7 10-4-1.8-7-5.4-7-10V6z"></path><path d="M9 12l2 2 4-4"></path></svg></div><div><h3>Тренеры с лицензиями UEFA</h3><p>Профессиональный штаб с лицензиями A, B и C UEFA и опытом работы в лучших академиях Москвы и России: «Динамо», «Сатурн», «Строгино», ФШМ, юношеские сборные.</p></div></div>
      <div class="card"><div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.7 5.5 6 .9-4.3 4.2 1 6-5.4-2.8-5.4 2.8 1-6L3.3 9.4l6-.9z"></path></svg></div><div><h3>Единая методика клуба</h3><p>Работа всех тренеров выстроена по единой методике и философии: в центре внимания — игрок, его обучение и развитие.</p></div></div>
      <div class="card"><div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 21h8M12 17v4M7 4h10v5a5 5 0 01-10 0z"></path><path d="M7 6H4a3 3 0 003 4M17 6h3a3 3 0 01-3 4"></path></svg></div><div><h3>Соревнования и турниры</h3><p>Регулярное участие команд в соревнованиях Московской Федерации Футбола в разных возрастах, товарищеские матчи, международные турниры и лагеря.</p></div></div>
      <div class="card"><div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10M10 20V4M16 20v-8M21 20H3"></path></svg></div><div><h3>Измеримый прогресс</h3><p>Футбольное тестирование в начале и конце сезона. Личный кабинет родителя в системе ProTrainUp: посещаемость, статистика, расписание, оплата — всё в телефоне.</p></div></div>
      <div class="card"><div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="4"></rect><path d="M12 8v8M8 12h8"></path></svg></div><div><h3>Медосмотр без хлопот</h3><p>Централизованное прохождение медосмотра в физкультурном диспансере — родителям не нужно самостоятельно оформлять справку о допуске.</p></div></div>
      <div class="card"><div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-4 9 4-9 4z"></path><path d="M7 11v4c0 1.5 2.2 3 5 3s5-1.5 5-3v-4M21 9v5"></path></svg></div><div><h3>Продвижение игроков</h3><p>Готовим и продвигаем юных футболистов в лучшие академии Москвы. Спортивный директор — Алексей Шерстнёв, главный тренер студенческой сборной России.</p></div></div>
    </div>
  </div>
</section>


<section class="section" id="coaches" style="background:var(--bg-soft)">
  <div class="wrap reveal">
    <div class="kicker">Тренерский штаб</div>
    <h2>Тренеры Академии</h2>
    <p class="sub" style="margin-bottom:32px">Тренировочный процесс курирует спортивный директор, тренеры работают по единой методике клуба.</p>
    <div class="grid g2">
      <div class="coach2">
        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/sherstnev.jpg')); ?>" alt="Алексей Шерстнёв">
        <div>
          <h3>Шерстнёв Алексей Михайлович</h3>
          <div class="role">Спортивный директор · старший тренер · лицензия A-UEFA</div>
          <p>Главный тренер студенческой сборной России по футболу. Курирует работу тренеров и весь тренировочный процесс школы.</p>
          <p>Опыт: академии «Динамо» Москва, «Сатурн», «Строгино», ФШМ, юношеские сборные Москвы. Карьера игрока: «Динамо» Москва, «Анжи», «Вентспилс».</p>
        </div>
      </div>
      <div class="coach2">
        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/img_20191109_162342-p5y50y99n551268ja7bmrl60xmozu6qu56a2eggvzk.jpg')); ?>" alt="Антон Котенёв">
        <div>
          <h3>Котенёв Антон Константинович</h3>
          <div class="role">Тренер Академии · КМС по футболу</div>
          <p>Кандидат в мастера спорта, чемпион Москвы по футболу среди команд спортивных школ.</p>
          <p>Опыт: ФК «Красногвардеец», ФК «Сельмаш», Академия ФК «Супер Нова». Карьера игрока: ФК «Ростов», «Строгино», ФШМ.</p>
        </div>
      </div>
    </div>
    <p class="coaches-more">Полный тренерский штаб — на странице <a href="<?php echo esc_url(home_url('/coaches/')); ?>">«Тренеры»</a>.</p>
  </div>
</section>


<section class="section" style="padding-top:0;background:var(--bg-soft)">
  <div class="wrap reveal">
    <div class="gallery">
      <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/huddle.jpg')); ?>" alt="Команда ФК Супер Нова с тренером перед игрой" loading="lazy" style="cursor: zoom-in;">
      <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/action.jpg')); ?>" alt="Игровой момент на тренировке ФК Супер Нова" loading="lazy" style="cursor: zoom-in;">
      <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/highfive.jpg')); ?>" alt="Игроки ФК Супер Нова празднуют гол" loading="lazy" style="cursor: zoom-in;">
    </div>
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
    <p class="sub" style="margin-bottom:28px">Записи матчей и трансляции — на YouTube-канале ФК «Супер Нова» ТВ.</p>
    <div class="video-card" id="videoCard" role="button" tabindex="0" aria-label="Смотреть видео матча">
      <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/maxresdefault.jpg')); ?>" alt="Матч ФК Супер Нова — ФК Герион" loading="lazy">
      <div class="play"><svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5z"></path></svg></div>
      <div class="vtitle">AFL Kids · Матч за 3-е место · Супер Нова — Герион 3:0</div>
    </div>
    <div style="text-align:center;margin-top:26px">
      <a class="btn btn-ghost" href="https://www.youtube.com/@fcsupernova" target="_blank" rel="noopener">Все видео на YouTube</a>
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
        <a class="btn" href="https://wa.me/79856692689">WhatsApp</a>
        <a class="btn" href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>">Telegram</a>
      </div>
      <img class="photo" src="<?php echo esc_url(get_theme_file_uri('/assets/images/boys.jpg')); ?>" alt="Юные игроки ФК Супер Нова" loading="lazy">
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
        <p><b>Мессенджеры:</b> <a href="https://wa.me/79856692689">WhatsApp</a> · <a href="<?php echo esc_url(zvezda_setting('telegram_url')); ?>">Telegram</a></p>
        <p><b>Соцсети:</b> <a href="<?php echo esc_url(zvezda_setting('vk_url')); ?>">VK</a> · <a href="https://www.youtube.com/@fcsupernova">YouTube</a> · <a href="https://www.instagram.com/fcsupernovamoscow" target="_blank" rel="noopener">Instagram</a></p>
        <p class="note">Ссылки на Instagram* и Facebook* убраны из прототипа: продукты Meta, признанной экстремистской организацией в РФ, требуют обязательной маркировки — решение и формулировку согласовать с юристом.</p>
      </div>
      
    </div>
  </div>
</section>
