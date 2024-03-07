<?php
function ls_like_post_layout()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_GET['settings-update'])) {
        add_settings_error('setting', 'setting_message', 'تنظیمات ذخیره گردید', 'update');
    }
    settings_errors('setting_message');

?>
    <div class="wrap" id="ls_menu_related">
        <form action="options.php" method="post" class="like-post">
            <h1><?= esc_html(get_admin_page_title()) ?></h1>
            <?php
            // نکته اگر از جدول option وردپرس خواستیم استفاده کنیم حتما این 3 تا متود زیر باید استفاده کنیم

            // تنظیمات امنیتی را ایجاد میکند و نامش باید یونیک باشه برای ذخیره سازی دیتا ها
            settings_fields('like-post');

            //نمایش خروجی html ما را انجام میده
            do_settings_sections('ls-like-post-html');

            //یک دکمه ذخیره برای ما ایجاد میکنه
            submit_button();
            ?>
        </form>
    </div>
<?php
}


function wp_ls_setting_init()
{
    //یک مجموغه ایجاد میکنه مثل یک div میمونه
    add_settings_section(
        'ls_related_post_setting_section',
        'تنظیمات نمایش اسلایدر',
        '',
        'ls-like-post-html'
    );

    //میایم تمام Input هایی که داریم توی فیلد قرار میدیم
    add_settings_field(
        'ls_settings_filds',
        'وردی ها ',
        'like_ls_render_html',
        'ls-like-post-html',
        'ls_related_post_setting_section'
    );

    //ذخیره دیتا ها در دیتابیس
    $args = [
        'type' => 'string',
        'sanitize_callback' => '_sanitize_text_fields',
        'default' => null,
    ];
    // register_setting('like-post', '_ls_title', $args);
    // register_setting('like-post', '_ls_number', $args);
    // register_setting('like-post', '_ls_according_to', $args);
    // register_setting('like-post', '_ls_order_by', $args);
    // register_setting('like-post', '_ls_show_type', $args);

    $settings_array = [
        '_ls_position_type',
    ];
    foreach ($settings_array as $setting_array) register_setting('like-post', $setting_array, $args);
}

add_action('admin_init', 'wp_ls_setting_init');


function like_ls_render_html()
{
    $ls_position = get_option('_ls_position_type');
?>
    <div class="element-wrapper">
        <div class="comment">
            <p>درصورت انتخاب (شناور) این کد را در هر قسمت که میخواهید لایک نمایش داده بشه قرار دهید </p>
            <pre>
                <code style="display: block;">
                    <span><</span><span>?</span><span>php</span>
                        <span>echo do_shortcode('[like-post]');</span>
                    <span>?</span><span>></span>
                </code>
            </pre>
        </div>

        <label for="position_type"></label>
        <select name="_ls_position_type" id="position_type">
            <option <?= selected($ls_position, 'static') ?> value="static">ثابت</option>
            <option <?= selected($ls_position, 'fixed') ?> value="fixed">شناور</option>
        </select>
    </div>
<?php
}
