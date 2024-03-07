jQuery(document).ready(function (e) {
    jQuery('#like').on('click', function (e) {
        if (jQuery(this).hasClass('unlike-button')) {

            e.preventDefault();
            let el = jQuery(this);
            let post_id = el.data('post-id');
            let user_id = el.data('user-id');
            let number_like = jQuery('#number_like');
            jQuery.ajax({
                url: ls_ajax.ls_ajaxurl,
                type: 'post',
                datatype: 'json',
                data: {
                    action: 'wp_ls_deslike_post',
                    nonce: ls_ajax._ls_nonce,
                    post_id: post_id,
                    user_id: user_id
                },
                beforeSend: function () {

                },
                success: function (response) {
                    if (response.success) {
                        el.removeClass('unlike-button');
                        number_like.text(response.like_number);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }

                },
                error: function (error) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        text: error.responseJSON.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
                complete: function () {

                }
            })
         return;
        } else {
            e.preventDefault();
            let el = jQuery(this);
            let post_id = el.data('post-id');
            let user_id = el.data('user-id');
            let number_like = jQuery('#number_like');
            jQuery.ajax({
                url: ls_ajax.ls_ajaxurl,
                type: 'post',
                datatype: 'json',
                data: {
                    action: 'wp_ls_like_post',
                    nonce: ls_ajax._ls_nonce,
                    post_id: post_id,
                    user_id: user_id
                },
                beforeSend: function () {

                },
                success: function (response) {
                    if (response.success) {
                        el.addClass('unlike-button');
                        number_like.text(response.like_number);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }

                },
                error: function (error) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        text: error.responseJSON.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
                complete: function () {

                }
            })

        }

    })

})
