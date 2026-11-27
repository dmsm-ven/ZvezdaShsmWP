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
        'yandex_reviews_url' => 'https://yandex.com/maps/org/fc_super_nova_moscow/155444875307/reviews/',
        'map_embed_url' => '',
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
        'yandex_reviews_url' => esc_url_raw($input['yandex_reviews_url'] ?? ''),
        'map_embed_url' => esc_url_raw($input['map_embed_url'] ?? ''),
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
                <tr><th><label for="zvezda-yandex-reviews">Ссылка на отзывы в Яндекс.Картах</label></th><td><input id="zvezda-yandex-reviews" class="regular-text" name="zvezda_club_settings[yandex_reviews_url]" value="<?php echo esc_attr($settings['yandex_reviews_url']); ?>" type="url"></td></tr>
                <tr><th><label for="zvezda-map-embed">Ссылка для встраивания карты</label></th><td><input id="zvezda-map-embed" class="large-text" name="zvezda_club_settings[map_embed_url]" value="<?php echo esc_attr($settings['map_embed_url']); ?>" type="url" placeholder="https://yandex.ru/map-widget/v1/..."><p class="description">В Яндекс.Картах откройте «Поделиться» → «Встроить карту» и скопируйте URL из атрибута src тега iframe (только сам URL, не весь HTML-код). Поддерживается URL виджета Яндекс.Карт или Google Maps Embed.</p></td></tr>
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
/**
 * Return only a trusted embeddable map URL configured by the site administrator.
 * Ordinary organization/share links are intentionally not treated as iframe URLs.
 */
function zvezda_map_embed_url() {
    $url = trim((string) zvezda_setting('map_embed_url'));
    if ($url === '') return '';

    $parts = wp_parse_url($url);
    if (empty($parts['scheme']) || strtolower($parts['scheme']) !== 'https' || empty($parts['host'])) {
        return '';
    }

    $host = strtolower($parts['host']);
    $allowed_hosts = [
        'yandex.ru',
        'www.yandex.ru',
        'yandex.com',
        'www.yandex.com',
        'maps.yandex.ru',
        'www.google.com',
        'maps.google.com',
        'google.ru',
        'www.google.ru',
    ];

    return in_array($host, $allowed_hosts, true) ? esc_url($url) : '';
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


/** FAQ entries managed from the WordPress admin. */
add_action('init', function () {
    register_post_type('faq', [
        'labels' => [
            'name' => 'Вопросы и ответы',
            'singular_name' => 'Вопрос',
            'add_new' => 'Добавить вопрос',
            'add_new_item' => 'Добавить вопрос',
            'edit_item' => 'Редактировать вопрос',
            'new_item' => 'Новый вопрос',
            'view_item' => 'Просмотр вопроса',
            'search_items' => 'Найти вопрос',
            'not_found' => 'Вопросы не найдены',
            'menu_name' => 'Вопросы и ответы',
        ],
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-editor-help',
        'menu_position' => 27,
        'supports' => ['title', 'page-attributes'],
        'has_archive' => false,
        'rewrite' => false,
        'show_in_rest' => true,
    ]);
});

/** Homepage testimonials managed as individual WordPress entries. */
add_action('init', function () {
    register_post_type('review', [
        'labels' => [
            'name' => 'Отзывы',
            'singular_name' => 'Отзыв',
            'add_new' => 'Добавить отзыв',
            'add_new_item' => 'Добавить отзыв',
            'edit_item' => 'Редактировать отзыв',
            'new_item' => 'Новый отзыв',
            'search_items' => 'Найти отзыв',
            'not_found' => 'Отзывы не найдены',
            'menu_name' => 'Отзывы',
        ],
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-format-quote',
        'menu_position' => 28,
        'supports' => ['title', 'page-attributes'],
        'has_archive' => false,
        'rewrite' => false,
        'show_in_rest' => true,
    ]);
});

/** Fields for each testimonial. */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group([
        'key' => 'group_zvezda_review_details',
        'title' => 'Данные отзыва',
        'menu_order' => 0,
        'fields' => [
            ['key' => 'field_zvezda_review_text', 'label' => 'Текст отзыва', 'name' => 'review_text', 'type' => 'textarea', 'rows' => 5, 'required' => 1],
            ['key' => 'field_zvezda_review_author', 'label' => 'Имя пользователя', 'name' => 'review_author', 'type' => 'text', 'required' => 1],
            ['key' => 'field_zvezda_review_source', 'label' => 'Источник', 'name' => 'review_source', 'type' => 'text', 'default_value' => 'Отзыв с Яндекс.Карт'],
            ['key' => 'field_zvezda_review_date', 'label' => 'Дата отзыва (необязательно)', 'name' => 'review_date', 'type' => 'date_picker', 'display_format' => 'd.m.Y', 'return_format' => 'd.m.Y', 'first_day' => 1],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'review']]],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
});

/** Keep the review author visible in the WordPress list table and row title. */
add_filter('manage_review_posts_columns', function ($columns) {
    if (isset($columns['title'])) $columns['title'] = 'Автор отзыва';
    return $columns;
});
add_action('manage_review_posts_custom_column', function ($column, $post_id) {
    if ($column !== 'title') return;
    $author = function_exists('get_field') ? get_field('review_author', $post_id) : get_post_meta($post_id, 'review_author', true);
    echo esc_html($author ?: get_the_title($post_id) ?: 'Без имени');
}, 10, 2);
function zvezda_sync_review_post_title($post_id) {
    $post_id = (int) $post_id;
    if (!$post_id || get_post_type($post_id) !== 'review' || !function_exists('get_field')) return;
    $author = trim((string) get_field('review_author', $post_id));
    $post = get_post($post_id);
    if ($author === '' || !$post || $post->post_title === $author) return;
    remove_action('acf/save_post', 'zvezda_sync_review_post_title', 20);
    wp_update_post(['ID' => $post_id, 'post_title' => $author]);
    add_action('acf/save_post', 'zvezda_sync_review_post_title', 20);
}
add_action('acf/save_post', 'zvezda_sync_review_post_title', 20);

/** Preserve the three testimonials currently shown on the homepage. */
add_action('admin_init', function () {
    if (get_option('zvezda_review_defaults_created')) return;
    $existing = get_posts([
        'post_type' => 'review',
        'post_status' => 'any',
        'numberposts' => 1,
        'fields' => 'ids',
    ]);
    if ($existing) {
        update_option('zvezda_review_defaults_created', 1);
        return;
    }

    $defaults = [
        ['text' => 'Хорошая спортивная школа, тренера все опытные, дети многому научатся, посещая данную школу. Советую всем!', 'author' => 'Яна К.'],
        ['text' => 'Хорошая школа для будущих спортсменов. Сын занимается с большим удовольствием.', 'author' => 'Александр Баджурак'],
        ['text' => 'Ребёнку нравится, ходим 3 раза в неделю.', 'author' => 'Галина Хорошуненко'],
    ];

    foreach ($defaults as $index => $item) {
        $post_id = wp_insert_post([
            'post_type' => 'review',
            'post_status' => 'publish',
            'post_title' => $item['author'],
            'menu_order' => $index,
        ], true);
        if (is_wp_error($post_id)) continue;
        if (function_exists('update_field')) {
            update_field('field_zvezda_review_text', $item['text'], $post_id);
            update_field('field_zvezda_review_author', $item['author'], $post_id);
            update_field('field_zvezda_review_source', 'Отзыв с Яндекс.Карт', $post_id);
        } else {
            update_post_meta($post_id, 'review_text', $item['text']);
            update_post_meta($post_id, 'review_author', $item['author']);
            update_post_meta($post_id, 'review_source', 'Отзыв с Яндекс.Карт');
        }
    }
    update_option('zvezda_review_defaults_created', 1);
});

/** ACF answer field for each FAQ entry. */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group([
        'key' => 'group_zvezda_faq_details',
        'title' => 'Ответ на вопрос',
        'menu_order' => 0,
        'fields' => [[
            'key' => 'field_zvezda_faq_answer',
            'label' => 'Ответ',
            'name' => 'faq_answer',
            'type' => 'textarea',
            'rows' => 5,
            'new_lines' => 'br',
            'required' => 1,
        ]],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'faq']]],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
});

/** Add the current homepage questions once on existing installations. */
add_action('admin_init', function () {
    if (get_option('zvezda_faq_defaults_created')) return;
    $existing = get_posts([
        'post_type' => 'faq',
        'post_status' => 'any',
        'numberposts' => 1,
        'fields' => 'ids',
    ]);
    if ($existing) {
        update_option('zvezda_faq_defaults_created', 1);
        return;
    }

    $defaults = [
        [
            'question' => 'Сколько стоит обучение?',
            'answer' => 'Месячный абонемент: 9 500 ₽ — 3 тренировки в неделю, 7 000 ₽ — 2 тренировки, 5 000 ₽ — 1 тренировка. Первая пробная тренировка бесплатна для всех.',
        ],
        [
            'question' => 'Детей какого возраста вы принимаете?',
            'answer' => 'Принимаем детей 5–12 лет. Набор в школу проходит круглый год, группы формируются по возрасту.',
        ],
        [
            'question' => 'Что взять с собой на пробную тренировку?',
            'answer' => 'Спортивную форму и обувь по погоде. Приезжайте за 15 минут до начала занятия. Записаться можно через форму на сайте или по телефону ' . zvezda_setting('phone') . '.',
        ],
        [
            'question' => 'Нужна ли медицинская справка?',
            'answer' => 'Клуб организует централизованное прохождение медосмотра в физкультурном диспансере — самостоятельно оформлять справку о допуске не нужно.',
        ],
        [
            'question' => 'Где и когда проходят тренировки?',
            'answer' => 'В спортивном комплексе «Фили» (' . zvezda_setting('address') . '): вторник и четверг 19:00–20:15, воскресенье 15:00–16:15. Зимой занятия проходят в зале и на поле с искусственной травой. Выходные — игровые дни.',
        ],
        [
            'question' => 'Как следить за прогрессом ребёнка?',
            'answer' => 'У каждого родителя есть личный кабинет в системе ProTrainUp: посещаемость, статистика тренировок и матчей, расписание, оплата абонемента и связь с тренером — всё в мобильном приложении.',
        ],
        [
            'question' => 'Участвуют ли команды в соревнованиях?',
            'answer' => 'Да, команды клуба регулярно играют в соревнованиях Московской Федерации Футбола в разных возрастных категориях, проводят товарищеские матчи и выезжают на турниры и сборы, включая международные.',
        ],
    ];

    foreach ($defaults as $index => $item) {
        $post_id = wp_insert_post([
            'post_type' => 'faq',
            'post_status' => 'publish',
            'post_title' => $item['question'],
            'menu_order' => $index,
        ], true);
        if (!is_wp_error($post_id) && function_exists('update_field')) {
            update_field('field_zvezda_faq_answer', $item['answer'], $post_id);
        } elseif (!is_wp_error($post_id)) {
            update_post_meta($post_id, 'faq_answer', $item['answer']);
        }
    }

    update_option('zvezda_faq_defaults_created', 1);
});

// Repeatable coach titles editor (does not require ACF Pro).
add_action('add_meta_boxes_coach', function () {
    add_meta_box(
        'zvezda_coach_titles',
        'Титулы и должности',
        'zvezda_render_coach_titles_metabox',
        'coach',
        'normal',
        'high'
    );
});

function zvezda_render_coach_titles_metabox($post) {
    wp_nonce_field('zvezda_save_coach_titles', 'zvezda_coach_titles_nonce');
    $titles = get_post_meta($post->ID, '_coach_titles_list', true);
    if (!is_array($titles) || !$titles) {
        $legacy = function_exists('get_field') ? get_field('coach_titles', $post->ID) : '';
        $titles = $legacy ? preg_split('/\\s*·\\s*|\\r?\\n/', $legacy) : [''];
    }
    ?>
    <div id="zvezda-coach-titles-list">
        <?php foreach ($titles as $title) : ?>
            <div class="zvezda-coach-title-row" style="display:flex;gap:8px;margin:0 0 8px;max-width:720px">
                <input type="text" name="coach_titles_list[]" value="<?php echo esc_attr($title); ?>" class="widefat" placeholder="Например: Спортивный директор">
                <button type="button" class="button zvezda-remove-coach-title">Удалить</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button button-secondary" id="zvezda-add-coach-title">+ Добавить титул</button>
    <p class="description">Каждый титул или должность добавляется отдельной строкой. На сайте они будут объединены символом « · ».</p>
    <?php
}

add_action('save_post_coach', function ($post_id) {
    if (
        !isset($_POST['zvezda_coach_titles_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['zvezda_coach_titles_nonce'])), 'zvezda_save_coach_titles') ||
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        !current_user_can('edit_post', $post_id)
    ) {
        return;
    }

    $titles = isset($_POST['coach_titles_list']) && is_array($_POST['coach_titles_list'])
        ? array_map('sanitize_text_field', wp_unslash($_POST['coach_titles_list']))
        : [];
    $titles = array_values(array_filter(array_map('trim', $titles), static function ($value) {
        return $value !== '';
    }));

    if ($titles) {
        update_post_meta($post_id, '_coach_titles_list', $titles);
    } else {
        delete_post_meta($post_id, '_coach_titles_list');
    }
}, 10);

add_action('admin_footer-post.php', 'zvezda_coach_titles_admin_script');
add_action('admin_footer-post-new.php', 'zvezda_coach_titles_admin_script');
function zvezda_coach_titles_admin_script() {
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'coach') return;
    ?>
    <script>
    (function () {
        const list = document.getElementById('zvezda-coach-titles-list');
        const add = document.getElementById('zvezda-add-coach-title');
        if (!list || !add) return;
        add.addEventListener('click', function () {
            const row = document.createElement('div');
            row.className = 'zvezda-coach-title-row';
            row.style.cssText = 'display:flex;gap:8px;margin:0 0 8px;max-width:720px';
            row.innerHTML = '<input type="text" name="coach_titles_list[]" class="widefat" placeholder="Например: Спортивный директор"><button type="button" class="button zvezda-remove-coach-title">Удалить</button>';
            list.appendChild(row);
            row.querySelector('input').focus();
        });
        list.addEventListener('click', function (event) {
            if (event.target.classList.contains('zvezda-remove-coach-title')) {
                event.target.closest('.zvezda-coach-title-row').remove();
            }
        });
    })();
    </script>
    <?php
}

// Show the coach's ACF full name in the admin list instead of the empty post title.
add_filter('manage_coach_posts_columns', function ($columns) {
    if (isset($columns['title'])) $columns['title'] = 'ФИО';
    return $columns;
});
add_action('manage_coach_posts_custom_column', function ($column, $post_id) {
    if ($column !== 'title') return;
    $name = function_exists('get_field') ? get_field('coach_full_name', $post_id) : '';
    echo esc_html($name ?: get_the_title($post_id) ?: 'Без ФИО');
}, 10, 2);

// Keep the native WordPress post title in sync with the ACF coach full name.
// The admin Posts List Table reads post_title directly when building its row link.
function zvezda_sync_coach_post_title($post_id) {
    $post_id = (int) $post_id;
    if (!$post_id || get_post_type($post_id) !== 'coach' || !function_exists('get_field')) {
        return;
    }

    $coach_name = trim((string) get_field('coach_full_name', $post_id));
    if ($coach_name === '') {
        return;
    }

    $post = get_post($post_id);
    if (!$post || $post->post_title === $coach_name) {
        return;
    }

    remove_action('acf/save_post', 'zvezda_sync_coach_post_title', 20);
    wp_update_post([
        'ID' => $post_id,
        'post_title' => $coach_name,
    ]);
    add_action('acf/save_post', 'zvezda_sync_coach_post_title', 20);
}
add_action('acf/save_post', 'zvezda_sync_coach_post_title', 20);

// One-time migration for coach records created before post_title synchronization.
add_action('admin_init', function () {
    if (get_option('zvezda_coach_titles_synced_to_post_title') || !function_exists('get_field')) {
        return;
    }

    $coach_ids = get_posts([
        'post_type' => 'coach',
        'post_status' => 'any',
        'numberposts' => -1,
        'fields' => 'ids',
        'orderby' => 'ID',
        'order' => 'ASC',
    ]);

    foreach ($coach_ids as $coach_id) {
        $post = get_post($coach_id);
        if (!$post || $post->post_title !== '') {
            continue;
        }

        $coach_name = trim((string) get_field('coach_full_name', $coach_id));
        if ($coach_name !== '') {
            wp_update_post([
                'ID' => $coach_id,
                'post_title' => $coach_name,
            ]);
        }
    }

    update_option('zvezda_coach_titles_synced_to_post_title', 1);
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
        'menu_order' => 0,
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
        [
            'key' => 'field_zvezda_banner_background_image',
            'label' => 'Фоновое изображение баннера',
            'name' => 'banner_background_image',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'large',
            'library' => 'all',
            'instructions' => 'Рекомендуемый размер: 2560 × 1200 px (минимум 1920 × 900 px), горизонтальное изображение примерно 2:1. Формат JPG или WebP, качество 80–90%. Для максимальной чёткости загружайте оригинал, а не миниатюру или изображение из мессенджера. Фон отображается с обрезкой по краям (cover), поэтому не размещайте лица и важные детали у самых краёв.'
        ],
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
        'menu_order' => 2,
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
        'menu_order' => 3,
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
        'menu_order' => 4,
        'fields' => $benefit_fields,
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    // Homepage video: the video is loaded only after the visitor clicks the preview.
    acf_add_local_field_group([
        'key' => 'group_zvezda_home_video',
        'title' => 'Главная — Видео',
        'menu_order' => 6,
        'fields' => [
            ['key' => 'field_zvezda_video_title', 'label' => 'Заголовок H2', 'name' => 'video_title', 'type' => 'text', 'default_value' => 'Смотрите матчи клуба'],
            ['key' => 'field_zvezda_video_subtitle', 'label' => 'Подзаголовок', 'name' => 'video_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Записи матчей и трансляции — на YouTube-канале ФК «СУПЕР НОВА» ТВ.'],
            ['key' => 'field_zvezda_video_url', 'label' => 'URL видео YouTube', 'name' => 'video_url', 'type' => 'url', 'instructions' => 'Вставьте ссылку на конкретное видео YouTube (watch, youtu.be, shorts или embed).'],
            ['key' => 'field_zvezda_video_preview_image', 'label' => 'Preview Image', 'name' => 'video_preview_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'large', 'library' => 'all', 'instructions' => 'Изображение показывается до клика. Сам YouTube iframe загружается только после нажатия.'],
        ],
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    // Schedule and membership content use ordinary text fields (compatible with ACF Free).
    $schedule_fields = [
        ['key' => 'field_zvezda_schedule_title', 'label' => 'Заголовок H2', 'name' => 'schedule_title', 'type' => 'text', 'default_value' => 'Тренировки в СК «Фили»'],
        ['key' => 'field_zvezda_schedule_subtitle', 'label' => 'Подзаголовок', 'name' => 'schedule_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Поле с искусственной травой последнего поколения, зимой — занятия в зале.'],
        ['key' => 'field_zvezda_schedule_tab', 'label' => 'Расписание', 'type' => 'tab', 'placement' => 'top'],
        ['key' => 'field_zvezda_schedule_days_title', 'label' => 'Заголовок карточки расписания', 'name' => 'schedule_days_title', 'type' => 'text', 'default_value' => 'Расписание · сезон 2026/27'],
    ];
    $schedule_slots = [
        ['monday', 'Понедельник', ''],
        ['tuesday', 'Вторник', '19:00 — 20:15'],
        ['wednesday', 'Среда', ''],
        ['thursday', 'Четверг', '19:00 — 20:15'],
        ['friday', 'Пятница', ''],
        ['saturday', 'Суббота', ''],
        ['sunday', 'Воскресенье', '15:00 — 16:15'],
        ['weekend', 'Суббота / Воскресенье', 'игровые дни'],
    ];
    foreach ($schedule_slots as $slot) {
        [$slug, $label, $default] = $slot;
        $schedule_fields[] = [
            'key' => "field_zvezda_schedule_{$slug}",
            'label' => $label,
            'name' => "schedule_{$slug}",
            'type' => 'text',
            'default_value' => $default,
        ];
    }
    $schedule_fields[] = [
        'key' => 'field_zvezda_schedule_footer',
        'label' => 'Текст под расписанием',
        'name' => 'schedule_footer',
        'type' => 'textarea',
        'rows' => 3,
        'default_value' => 'Время указано по действующему расписанию — перед стартом сезона уточняется для каждой возрастной группы.',
    ];
    $schedule_fields[] = ['key' => 'field_zvezda_tariffs_tab', 'label' => 'Тарифы', 'type' => 'tab', 'placement' => 'top'];
    $tariff_defaults = [
        ['5 000 ₽', '1 тренировка в неделю', 'Мягкий старт: для самых маленьких и для совмещения с другими секциями.'],
        ['7 000 ₽', '2 тренировки в неделю', 'Стабильный ритм: техника и игровая практика каждую неделю.'],
        ['9 500 ₽', '3 тренировки в неделю', 'Максимальный прогресс: полный тренировочный цикл плюс игровые дни.'],
    ];
    for ($i = 1; $i <= 3; $i++) {
        $schedule_fields[] = ['key' => "field_zvezda_tariff_{$i}_price", 'label' => "Предложение {$i} — цена за месяц", 'name' => "tariff_{$i}_price", 'type' => 'text', 'default_value' => $tariff_defaults[$i - 1][0]];
        $schedule_fields[] = ['key' => "field_zvezda_tariff_{$i}_per", 'label' => "Предложение {$i} — количество тренировок", 'name' => "tariff_{$i}_per", 'type' => 'text', 'default_value' => $tariff_defaults[$i - 1][1]];
        $schedule_fields[] = ['key' => "field_zvezda_tariff_{$i}_description", 'label' => "Предложение {$i} — описание", 'name' => "tariff_{$i}_description", 'type' => 'textarea', 'rows' => 3, 'default_value' => $tariff_defaults[$i - 1][2]];
    }
    $schedule_fields[] = ['key' => 'field_zvezda_membership_tab', 'label' => 'Что входит в абонемент', 'type' => 'tab', 'placement' => 'top'];
    $schedule_fields[] = [
        'key' => 'field_zvezda_membership_title',
        'label' => 'Заголовок карточки',
        'name' => 'membership_title',
        'type' => 'text',
        'default_value' => 'Что входит в абонемент',
    ];
    $membership_defaults = [
        'Первая пробная тренировка — бесплатно',
        'Тренеры с лицензиями UEFA',
        'Тестирование игроков 2 раза в год',
        'Личный кабинет родителя в ProTrainUp',
        'Централизованный медосмотр',
        'Игровые дни по выходным',
    ];
    for ($i = 1; $i <= 6; $i++) {
        $schedule_fields[] = [
            'key' => "field_zvezda_membership_item_{$i}",
            'label' => "Пункт {$i}",
            'name' => "membership_item_{$i}",
            'type' => 'text',
            'default_value' => $membership_defaults[$i - 1],
        ];
    }
    acf_add_local_field_group([
        'key' => 'group_zvezda_home_schedule',
        'title' => 'Главная — Расписание и стоимость',
        'menu_order' => 7,
        'fields' => $schedule_fields,
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    // Signup section content: editable heading, copy and photo (ACF Free compatible).
    acf_add_local_field_group([
        'key' => 'group_zvezda_home_signup',
        'title' => 'Главная — Запись',
        'menu_order' => 8,
        'fields' => [
            ['key' => 'field_zvezda_signup_title', 'label' => 'Заголовок H2', 'name' => 'signup_title', 'type' => 'text', 'default_value' => 'Первая тренировка — бесплатно'],
            ['key' => 'field_zvezda_signup_description', 'label' => 'Текст под заголовком', 'name' => 'signup_description', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Оставьте заявку — перезвоним, подберём группу по возрасту и пригласим на пробное занятие. Или напишите нам в мессенджер, так быстрее.'],
            ['key' => 'field_zvezda_signup_photo', 'label' => 'Фотография', 'name' => 'signup_photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'library' => 'all'],
            ['key' => 'field_zvezda_signup_photo_alt', 'label' => 'ALT-текст фотографии', 'name' => 'signup_photo_alt', 'type' => 'text', 'default_value' => 'Юные игроки ФК «СУПЕР НОВА»', 'instructions' => 'Кратко опишите, что изображено на фотографии.'],
        ],
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_zvezda_home_gallery',
        'title' => 'Главная — фотогалерея',
        'menu_order' => 5,
        'fields' => [
            [
                'key' => 'field_zvezda_gallery_image_1',
                'label' => 'Фото 1',
                'name' => 'gallery_image_1',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ],
            [
                'key' => 'field_zvezda_gallery_image_1_alt',
                'label' => 'Фото 1 — ALT-текст',
                'name' => 'gallery_image_1_alt',
                'type' => 'text',
                'default_value' => 'Команда с тренером перед игрой',
                'instructions' => 'Краткое описание изображения для доступности и поисковых систем.',
            ],
            [
                'key' => 'field_zvezda_gallery_image_2',
                'label' => 'Фото 2',
                'name' => 'gallery_image_2',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ],
            [
                'key' => 'field_zvezda_gallery_image_2_alt',
                'label' => 'Фото 2 — ALT-текст',
                'name' => 'gallery_image_2_alt',
                'type' => 'text',
                'default_value' => 'Игровой момент на тренировке',
                'instructions' => 'Краткое описание изображения для доступности и поисковых систем.',
            ],
            [
                'key' => 'field_zvezda_gallery_image_3',
                'label' => 'Фото 3',
                'name' => 'gallery_image_3',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ],
            [
                'key' => 'field_zvezda_gallery_image_3_alt',
                'label' => 'Фото 3 — ALT-текст',
                'name' => 'gallery_image_3_alt',
                'type' => 'text',
                'default_value' => 'Игроки празднуют гол',
                'instructions' => 'Краткое описание изображения для доступности и поисковых систем.',
            ],
        ],
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
        'title' => 'Главная — Баннер',
        'menu_order' => 1,
        'fields' => $fields,
        'location' => $location,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
});
