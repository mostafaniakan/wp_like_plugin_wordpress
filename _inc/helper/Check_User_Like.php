<?php

namespace check_user_like;

class Check_User_Like
{
    
    public static function check_user_likes($user_id,$post_id){
        $user_like_post_ids = get_user_meta($user_id, '_ls_like_post_ids', true);

        if (is_array($user_like_post_ids) && in_array($post_id, $user_like_post_ids)) {
            return 'is-liked unlike-button';
        }
    }
}
