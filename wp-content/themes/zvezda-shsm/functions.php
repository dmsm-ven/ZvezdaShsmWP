<?php
/**
 * Настройки темы и регистрация функциональности.
 */
function zvezda_club_settings_defaults() {
    return [
        'phone' => '+7 (985) 669-26-89',
        'email' => 'info@fcsupernova.ru',
        'vk_url' => 'https://vk.com/fcsupernova',
        'telegram_url' => 'https://t.me/fcsupernovamoscow',
        'youtube_url' => 'https://www.youtube.com/@fcsupernova',
        'address' => 'Россия, г. Москва, ул. Новозаводская, 27А стр. 1 (СК «Фили»), м. Багратионовская',
        'logo_id' => 0,
        'club_name' => 'ФК «СУПЕР НОВА»',
        'footer_description' => 'Детско-юношеский футбольный клуб и школа футбола. Тренировочный процесс — под руководством тренеров с лицензиями UEFA.',
    ];
}
function zvezda_setting($key, $default = '') {
    $settings = get_option('zvezda_club_settings', []);
    $defaults = zvezda_club_settings_defaults();
    if (isset($settings[$key]) && $settings[$key] !== '') return $settings[$key];
    if ($default !== '') return $default;
    return $defaults[$key] ?? '';
}
function zvezda_opt($key, $default = '') {
    $value = zvezda_setting($key, '');
    if ($value !== '') return $value;
    if (function_exists('get_field')) {
        $acf_value = get_field($key, 'option');
        if ($acf_value !== null && $acf_value !== false && $acf_value !== '') return $acf_value;
    }
    return $default;
}
function zvezda_club_settings_sanitize($input) {
    $input = is_array($input) ? $input : [];
    return [
        'phone' => sanitize_text_field($input['phone'] ?? ''),
        'email' => sanitize_email($input['email'] ?? ''),
        'vk_url' => esc_url_raw($input['vk_url'] ?? ''),
        'telegram_url' => esc_url_raw($input['telegram_url'] ?? ''),
        'youtube_url' => esc_url_raw($input['youtube_url'] ?? ''),
        'address' => sanitize_text_field($input['address'] ?? ''),
        'logo_id' => absint($input['logo_id'] ?? 0),
        'club_name' => sanitize_text_field($input['club_name'] ?? ''),
        'footer_description' => sanitize_textarea_field($input['footer_description'] ?? ''),
    ];
}
add_action('admin_menu', function () {
    add_theme_page('Настройки клуба', 'Настройки клуба', 'manage_options', 'zvezda-club-settings', 'zvezda_render_club_settings_page');
});
add_action('admin_init', function () {
    register_setting('zvezda_club_settings_group', 'zvezda_club_settings', ['sanitize_callback' => 'zvezda_club_settings_sanitize']);
});
function zvezda_render_club_settings_page() {
    if (!current_user_can('manage_options')) return;
    $defaults = zvezda_club_settings_defaults();
    $settings = wp_parse_args(get_option('zvezda_club_settings', []), $defaults);
    $logo_url = !empty($settings['logo_id']) ? wp_get_attachment_image_url($settings['logo_id'], 'medium') : '';
    ?>
    <div class="wrap">
        <h1>Настройки клуба</h1>
        <p>Контактная информация и данные клуба используются в шапке, на главной странице и в подвале сайта.</p>
        <form method="post" action="options.php">
            <?php settings_fields('zvezda_club_settings_group'); ?>
            <table class="form-table" role="presentation">
                <tr><th><label for="zvezda-phone">Телефон</label></th><td><input id="zvezda-phone" class="regular-text" name="zvezda_club_settings[phone]" value="<?php echo esc_attr($settings['phone']); ?>" type="text"></td></tr>
                <tr><th><label for="zvezda-email">Email</label></th><td><input id="zvezda-email" class="regular-text" name="zvezda_club_settings[email]" value="<?php echo esc_attr($settings['email']); ?>" type="email"></td></tr>
                <tr><th><label for="zvezda-vk">Адрес VK</label></th><td><input id="zvezda-vk" class="regular-text" name="zvezda_club_settings[vk_url]" value="<?php echo esc_attr($settings['vk_url']); ?>" type="url"></td></tr>
                <tr><th><label for="zvezda-telegram">Адрес Telegram</label></th><td><input id="zvezda-telegram" class="regular-text" name="zvezda_club_settings[telegram_url]" value="<?php echo esc_attr($settings['telegram_url']); ?>" type="url"></td></tr>
                <tr><th><label for="zvezda-youtube">Адрес YouTube</label></th><td><input id="zvezda-youtube" class="regular-text" name="zvezda_club_settings[youtube_url]" value="<?php echo esc_attr($settings['youtube_url']); ?>" type="url"></td></tr>
                <tr><th><label for="zvezda-address">Физический адрес</label></th><td><input id="zvezda-address" class="regular-text" name="zvezda_club_settings[address]" value="<?php echo esc_attr($settings['address']); ?>" type="text"></td></tr>
                <tr><th>Логотип</th><td>
                    <input id="zvezda-logo-id" name="zvezda_club_settings[logo_id]" value="<?php echo esc_attr($settings['logo_id']); ?>" type="hidden">
                    <div id="zvezda-logo-preview"><?php if ($logo_url) : ?><img src="<?php echo esc_url($logo_url); ?>" style="max-width:180px;height:auto;display:block;margin-bottom:10px" alt=""><?php endif; ?></div>
                    <button type="button" class="button" id="zvezda-select-logo">Выбрать логотип</button>
                    <button type="button" class="button" id="zvezda-remove-logo">Убрать</button>
                </td></tr>
                <tr><th><label for="zvezda-club-name">Название клуба</label></th><td><input id="zvezda-club-name" class="regular-text" name="zvezda_club_settings[club_name]" value="<?php echo esc_attr($settings['club_name']); ?>" type="text"></td></tr>
                <tr><th><label for="zvezda-footer-description">Короткое описание в подвале</label></th><td><textarea id="zvezda-footer-description" class="large-text" rows="3" name="zvezda_club_settings[footer_description]"><?php echo esc_textarea($settings['footer_description']); ?></textarea></td></tr>
            </table>
            <?php submit_button('Сохранить настройки'); ?>
        </form>
    </div>
    <?php
}
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook === 'appearance_page_zvezda-club-settings') wp_enqueue_media();
});
add_action('admin_footer-appearance_page_zvezda-club-settings', function () {
    ?>
    <script>
    jQuery(function ($) {
        let logoFrame;
        $('#zvezda-select-logo').on('click', function (event) {
            event.preventDefault();
            if (logoFrame) { logoFrame.open(); return; }
            logoFrame = wp.media({ title: 'Выберите логотип клуба', button: { text: 'Использовать логотип' }, library: { type: 'image' }, multiple: false });
            logoFrame.on('select', function () {
                const attachment = logoFrame.state().get('selection').first().toJSON();
                $('#zvezda-logo-id').val(attachment.id);
                const imageUrl = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
                $('#zvezda-logo-preview').empty().append($('<img>', { src: imageUrl, alt: '', css: { maxWidth: '180px', height: 'auto', display: 'block', marginBottom: '10px' } }));
            });
            logoFrame.open();
        });
        $('#zvezda-remove-logo').on('click', function () { $('#zvezda-logo-id').val('0'); $('#zvezda-logo-preview').empty(); });
    });
    </script>
    <?php
});
function zvezda_club_logo_url() {
    $logo_id = absint(zvezda_setting('logo_id', 0));
    if ($logo_id) {
        $url = wp_get_attachment_image_url($logo_id, 'full');
        if ($url) return $url;
    }
    return get_theme_file_uri('/assets/images/logo.png');
}
function zvezda_phone_href() {
    return preg_replace('/[^0-9+]/', '', zvezda_setting('phone'));
}
function zvezda_phone_digits() {
    return preg_replace('/[^0-9]/', '', zvezda_setting('phone'));
}
add_action('wp_enqueue_scripts', function () {
    $ver = wp_get_theme()->get('Version');
    wp_enqueue_style('zvezda-style', get_stylesheet_uri(), [], $ver);
    wp_enqueue_script('zvezda-main', get_stylesheet_directory_uri() . '/assets/js/main.js', [], $ver, true);
});
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    register_nav_menus(['primary' => 'Главное меню']);
});
add_action('init', function () {
    register_post_type('coach', [
        'labels' => [
            'name' => 'Тренеры',
            'singular_name' => 'Тренер',
            'add_new' => 'Добавить тренера',
            'add_new_item' => 'Добавить тренера',
            'edit_item' => 'Редактировать тренера',
            'new_item' => 'Новый тренер',
            'view_item' => 'Просмотр тренера',
            'search_items' => 'Найти тренера',
            'not_found' => 'Тренеры не найдены',
            'menu_name' => 'Тренеры',
        ],
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['thumbnail', 'page-attributes'],
        'has_archive' => false,
        'rewrite' => false,
        'show_in_rest' => true,
    ]);
});

/** ACF fields for the front page. */
function zvezda_home_field($key, $default = '') {
    if (function_exists('get_field')) {
        $page_id = (int) get_queried_object_id();
        $value = get_field($key, $page_id ?: false);
        if ($value !== null && $value !== false && $value !== '') return $value;
    }
    return $default;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;
    $location = [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]];
    acf_add_local_field_group([
        'key' => 'group_zvezda_home_topbar',
        'title' => 'Главная — верхняя полоса',
        'fields' => [[
            'key' => 'field_zvezda_topbar_full_text',
            'label' => 'Полный текст объявления',
            'name' => 'topbar_full_text',
            'type' => 'text',
            'default_value' => 'Открыт круглогодичный набор на сезон 2026/27 (дети 5–12 лет) — первая тренировка бесплатно',
        ]],
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
    $fields = [
        ['key' => 'field_zvezda_banner_title', 'label' => 'Заголовок', 'name' => 'banner_title', 'type' => 'text', 'default_value' => 'Академия'],
        ['key' => 'field_zvezda_banner_subtitle', 'label' => 'Подзаголовок', 'name' => 'banner_subtitle', 'type' => 'text', 'default_value' => 'совершенствуйся играя'],
        ['key' => 'field_zvezda_banner_description', 'label' => 'Краткое описание', 'name' => 'banner_description', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Играй. Общайся. Расти. Развивайся. Тренеры с лицензиями UEFA, единая методика подготовки и соревнования Московской Федерации Футбола.'],
        ['key' => 'field_zvezda_banner_fact_1_value', 'label' => 'Факт 1 — выделенное значение', 'name' => 'banner_fact_1_value', 'type' => 'text', 'default_value' => 'A / B / C'],
        ['key' => 'field_zvezda_banner_fact_1_text', 'label' => 'Факт 1 — подпись', 'name' => 'banner_fact_1_text', 'type' => 'text', 'default_value' => 'лицензии UEFA у тренеров'],
        ['key' => 'field_zvezda_banner_fact_2_value', 'label' => 'Факт 2 — выделенное значение', 'name' => 'banner_fact_2_value', 'type' => 'text', 'default_value' => 'СК «Фили»'],
        ['key' => 'field_zvezda_banner_fact_2_text', 'label' => 'Факт 2 — подпись', 'name' => 'banner_fact_2_text', 'type' => 'text', 'default_value' => 'м. Багратионовская'],
        ['key' => 'field_zvezda_banner_fact_3_value', 'label' => 'Факт 3 — выделенное значение', 'name' => 'banner_fact_3_value', 'type' => 'text', 'default_value' => '0 ₽'],
        ['key' => 'field_zvezda_banner_fact_3_text', 'label' => 'Факт 3 — подпись', 'name' => 'banner_fact_3_text', 'type' => 'text', 'default_value' => 'первая тренировка'],
    ];

    // Statistics strip: four editable value/label pairs.
    $stats_fields = [];
    for ($i = 1; $i <= 4; $i++) {
        $stats_fields[] = ['key' => "field_zvezda_stat_{$i}_value", 'label' => "Статистика {$i} — значение", 'name' => "stat_{$i}_value", 'type' => 'text'];
        $stats_fields[] = ['key' => "field_zvezda_stat_{$i}_text", 'label' => "Статистика {$i} — подпись", 'name' => "stat_{$i}_text", 'type' => 'text'];
    }
    acf_add_local_field_group([
        'key' => 'group_zvezda_home_stats',
        'title' => 'Главная — статистика',
        'fields' => $stats_fields,
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    // Age groups: section heading, subtitle and four age/description pairs.
    $age_fields = [
        ['key' => 'field_zvezda_age_title', 'label' => 'Заголовок', 'name' => 'age_title', 'type' => 'text', 'default_value' => 'Возрастные группы набора'],
        ['key' => 'field_zvezda_age_subtitle', 'label' => 'Подзаголовок', 'name' => 'age_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Круглогодичный набор юных футболистов. Группы формируются по годам рождения, программа адаптирована под возраст.'],
    ];
    $age_defaults = [
        ['5–6', 'Первые шаги в футболе: игра, координация, любовь к мячу'],
        ['7–8', 'Базовая техника, работа с мячом, командные игры'],
        ['9–10', 'Техника, тактические основы, товарищеские матчи'],
        ['11–12', 'Соревнования МФФ, тестирование, подготовка к академиям'],
    ];
    for ($i = 1; $i <= 4; $i++) {
        $age_fields[] = ['key' => "field_zvezda_age_{$i}_years", 'label' => "Группа {$i} — возраст", 'name' => "age_{$i}_years", 'type' => 'text', 'default_value' => $age_defaults[$i - 1][0]];
        $age_fields[] = ['key' => "field_zvezda_age_{$i}_text", 'label' => "Группа {$i} — описание", 'name' => "age_{$i}_text", 'type' => 'textarea', 'rows' => 2, 'default_value' => $age_defaults[$i - 1][1]];
    }
    acf_add_local_field_group([
        'key' => 'group_zvezda_home_age_groups',
        'title' => 'Главная — Кого мы ждём',
        'fields' => $age_fields,
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    // Benefits: heading/subheading and six icon/title/text items.
    $benefit_fields = [
        ['key' => 'field_zvezda_benefits_title', 'label' => 'Заголовок', 'name' => 'benefits_title', 'type' => 'text', 'default_value' => 'Что получает ваш ребёнок'],
        ['key' => 'field_zvezda_benefits_subtitle', 'label' => 'Подзаголовок', 'name' => 'benefits_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'В центре философии клуба — игрок. Главная задача школы — обучение и развитие игрока.'],
    ];
    $benefit_defaults = [
        ['Тренеры с лицензиями UEFA', 'Профессиональный штаб с лицензиями A, B и C UEFA и опытом работы в лучших академиях Москвы и России: «Динамо», «Сатурн», «Строгино», ФШМ, юношеские сборные.'],
        ['Единая методика клуба', 'Работа всех тренеров выстроена по единой методике и философии: в центре внимания — игрок, его обучение и развитие.'],
        ['Соревнования и турниры', 'Регулярное участие команд в соревнованиях Московской Федерации Футбола в разных возрастах, товарищеские матчи, международные турниры и лагеря.'],
        ['Измеримый прогресс', 'Футбольное тестирование в начале и конце сезона. Личный кабинет родителя в системе ProTrainUp: посещаемость, статистика, расписание, оплата — всё в телефоне.'],
        ['Медосмотр без хлопот', 'Централизованное прохождение медосмотра в физкультурном диспансере — родителям не нужно самостоятельно оформлять справку о допуске.'],
        ['Продвижение игроков', 'Готовим и продвигаем юных футболистов в лучшие академии Москвы. Спортивный директор — Алексей Шерстнёв, главный тренер студенческой сборной России.'],
    ];
    $benefit_icons = [
        '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.6-3 8.2-7 10-4-1.8-7-5.4-7-10V6z"></path><path d="M9 12l2 2 4-4"></path></svg>',
        '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.7 5.5 6 .9-4.3 4.2 1 6-5.4-2.8-5.4 2.8 1-6L3.3 9.4l6-.9z"></path></svg>',
        '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 21h8M12 17v4M7 4h10v5a5 5 0 01-10 0z"></path><path d="M7 6H4a3 3 0 003 4M17 6h3a3 3 0 01-3 4"></path></svg>',
        '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10M10 20V4M16 20v-8M21 20H3"></path></svg>',
        '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="4"></rect><path d="M12 8v8M8 12h8"></path></svg>',
        '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-4 9 4-9 4z"></path><path d="M7 11v4c0 1.5 2.2 3 5 3s5-1.5 5-3v-4M21 9v5"></path></svg>',
    ];
    for ($i = 1; $i <= 6; $i++) {
        $benefit_fields[] = ['key' => "field_zvezda_benefit_{$i}_icon", 'label' => "Пункт {$i} — иконка (SVG)", 'name' => "benefit_{$i}_icon", 'type' => 'textarea', 'rows' => 3, 'default_value' => $benefit_icons[$i - 1], 'instructions' => 'Можно вставить SVG-код иконки.'];
        $benefit_fields[] = ['key' => "field_zvezda_benefit_{$i}_title", 'label' => "Пункт {$i} — заголовок", 'name' => "benefit_{$i}_title", 'type' => 'text', 'default_value' => $benefit_defaults[$i - 1][0]];
        $benefit_fields[] = ['key' => "field_zvezda_benefit_{$i}_text", 'label' => "Пункт {$i} — текст", 'name' => "benefit_{$i}_text", 'type' => 'textarea', 'rows' => 4, 'default_value' => $benefit_defaults[$i - 1][1]];
    }
    acf_add_local_field_group([
        'key' => 'group_zvezda_home_benefits',
        'title' => 'Главная — Что получает ваш ребёнок',
        'fields' => $benefit_fields,
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_zvezda_coach_details',
        'title' => 'Данные тренера',
        'fields' => [
            [
                'key' => 'field_zvezda_coach_full_name',
                'label' => 'ФИО',
                'name' => 'coach_full_name',
                'type' => 'text',
                'required' => 1,
            ],
            [
                'key' => 'field_zvezda_coach_titles',
                'label' => 'Список титулов тренера',
                'name' => 'coach_titles',
                'type' => 'textarea',
                'rows' => 2,
                'instructions' => 'Например: Спортивный директор · старший тренер · лицензия A-UEFA',
                'required' => 1,
            ],
            [
                'key' => 'field_zvezda_coach_description',
                'label' => 'Общее описание',
                'name' => 'coach_description',
                'type' => 'textarea',
                'rows' => 4,
                'required' => 1,
            ],
            [
                'key' => 'field_zvezda_coach_experience',
                'label' => 'Опыт',
                'name' => 'coach_experience',
                'type' => 'textarea',
                'rows' => 4,
                'instructions' => 'Укажите опыт работы, клубы, академии и/или игровую карьеру.',
                'required' => 1,
            ],
            [
                'key' => 'field_zvezda_coach_show_on_home',
                'label' => 'Отображать на главной',
                'name' => 'coach_show_on_home',
                'type' => 'true_false',
                'ui' => 1,
                'ui_on_text' => 'Да',
                'ui_off_text' => 'Нет',
                'default_value' => 0,
                'instructions' => 'На главной отображаются максимум два отмеченных тренера.',
            ],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'coach']]],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_zvezda_home_main_banner',
        'title' => 'Main Banner',
        'fields' => $fields,
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
});
