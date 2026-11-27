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
        'label' => 'Тренеры',
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => false,
        'show_in_rest' => true,
    ]);
});
