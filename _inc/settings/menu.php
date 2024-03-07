<?php
function wp_ls_like_menu(){

    //در منوی اصلی قرار میگیره 
    // add_menu_page(
    //     'لایک',
    //     'لایک پست ها',
    //     'manage_options',
    //     'like_post_setting',
    //     'ls_like_post_layout',
    //     '',
    //     40);

//درمنوی تنظیمات قرار میگیره
        add_options_page(
            'لایک',
            'تنظیمات پلاگین لایک مطالب',
            'manage_options',
            'like_post_setting',
            'ls_like_post_layout',
            '');
}
include_once LS_PLUGIN_DIR.'_inc/settings/setting.php';
add_action('admin_menu','wp_ls_like_menu');