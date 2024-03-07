<?php

use check_user_like\Check_User_Like;

function wp_ls_like_posts_layout()
{

?>
    <div class="<?php switch (get_option('_ls_position_type')) {
                    case 'fixed':
                        echo 'like-container';
                    default:
                    echo 'like-container';
                }
                ?>">
        <div class="middle-wrapper" style="display: flex;flex-direction: row-reverse">
            <p id="number_like" class="<?= check_user_like::check_user_likes(get_current_user_id(), get_the_ID()) ?>"><?= get_post_meta(get_the_ID(), '_ls_like_number', true) ?></p>
            <button class="tweet-heart <?= check_user_like::check_user_likes(get_current_user_id(), get_the_ID()) ?>" id="like" data-post-id="<?= get_the_ID() ?>" data-user-id="<?= get_current_user_id() ?>"></button>
        </div>

    </div>
<?php
}

add_shortcode('like-post', 'wp_ls_like_posts_layout');
