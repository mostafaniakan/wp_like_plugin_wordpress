<?php
function wp_ls_deslike_post()
{
    if (isset($_POST['nonce']) && !wp_verify_nonce($_POST['nonce'])) {
        die(' assess denied!!!');
    }

    if (!is_user_logged_in()) {

        wp_send_json([
            'error' => true,
            'message' => 'برای لایک این مطلب ابتدا باید لاگین نمایید.',
        ], 403);
    }
    if (!empty($_POST['post_id']) && !empty($_POST['user_id']) && intval($_POST['post_id']) && intval($_POST['user_id'])) {

        $post_id = intval($_POST['post_id']);
        $user_id = intval($_POST['user_id']);

        //توی متا ها میگرده ببینه ایا مقدار وجود داره یانه
        if (metadata_exists('user', $user_id, '_ls_like_post_ids')) {
            $meta_value = get_user_meta($user_id, '_ls_like_post_ids', true);
            //تفاوت هارا برمیگرداند و اون مشابه باشه را برنمیگرداند
            $updated_meta_value = array_diff($meta_value, [$post_id]);
            update_user_meta($user_id, '_ls_like_post_ids', $updated_meta_value);
        } else {
            wp_send_json([
                'error' => true,
                'message' => 'شما هنوز این پست را لایک نکرده اید',
                'like_number' => get_post_meta($post_id, '_ls_like_number', true)
            ], 400);
        }

        add_to_deslike_counter($post_id);

        wp_send_json([
            'success' => true,
            'message' => 'لایک شما حذف شد',
            'like_number' => get_post_meta($post_id, '_ls_like_number', true)
        ], 200);
    } else {
        wp_send_json([
            'error' => true,
            'message' => 'خطایی رخ داده است'
        ], 403);
    }
}



function add_to_deslike_counter($post_id)
{
    if (!metadata_exists('post', $post_id, '_ls_like_number')) {
        add_post_meta($post_id, '_ls_like_number', 1);
    } else {
        $like_number = get_post_meta($post_id, '_ls_like_number', true);
        $like_number--;
        update_post_meta($post_id, '_ls_like_number', $like_number);
    }
}
add_action('wp_ajax_wp_ls_deslike_post', 'wp_ls_deslike_post');
add_action('wp_ajax_nopriv_wp_ls_deslike_post', 'wp_ls_deslike_post');
