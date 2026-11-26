<?php
// Значение из ACF (страница настроек) или запасное, пока ACF не настроен
function zvezda_opt($key, $default = '') {
    if (function_exists('get_field')) {
        $v = get_field($key, 'option');
        if ($v !== null && $v !== false && $v !== '') return $v;
    }
    return $default;
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
