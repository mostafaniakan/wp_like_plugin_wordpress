<?php
/**
 * @package Hello_Dolly
 * @version 1.7.2
 */
/*
Plugin Name: لایک مطالب
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description:  wp like system
Author: mostafa nk
Version: 1.0.0
Author URI: http://localhost
*/
defined('ABSPATH') || exit;


define('LS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('LS_PLUGIN_URL', plugin_dir_url(__FILE__));
const LS_INC = LS_PLUGIN_DIR . '_inc/';
const LS_VIEW = LS_PLUGIN_DIR . 'view/';

function wp_ls_register_assets()
{
    //css
    wp_register_style('ls-style', LS_PLUGIN_URL . 'assets/css/style.css', '', '1.0.0');
    wp_enqueue_style('ls-style');

    //js
    wp_register_script('ls-main-js', LS_PLUGIN_URL . 'assets/js/main.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('ls-main-js');

    wp_register_script('ls-ajax-js', LS_PLUGIN_URL . 'assets/js/front/ajax.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('ls-ajax-js');



    wp_register_script('ls-sweep','https://cdn.jsdelivr.net/npm/sweetalert2@11',['jquery'],'2.0.11');
     wp_enqueue_script('ls-sweep');
    wp_localize_script('ls-ajax-js','ls_ajax',[
        'ls_ajaxurl'=>admin_url('admin-ajax.php'),
        '_ls_nonce'=>wp_create_nonce(),
        '_ls_user_id'=>get_current_user_id()
    ]);
}

add_action('wp_enqueue_scripts', 'wp_ls_register_assets');

function wp_ls_register_assets_admin()
{
    //css
    wp_register_style('ls-admin-style', LS_PLUGIN_URL . 'assets/css/admin/admin-style.css', '', '1.0.0');
    wp_enqueue_style('ls-admin-style');

    //js
}

add_action('admin_enqueue_scripts', 'wp_ls_register_assets_admin');

include_once LS_PLUGIN_DIR.'view/front/like.php';
include_once LS_PLUGIN_DIR.'_inc/settings/setting.php';
include_once LS_PLUGIN_DIR.'_inc/settings/menu.php';
include_once LS_PLUGIN_DIR.'_inc/like/like-post.php';
include_once LS_PLUGIN_DIR.'_inc/like/deslike-post.php';
include_once LS_PLUGIN_DIR.'_inc/helper/Check_User_Like.php';