<?php

/* プロフィール欄の不要項目を、jQueryで削除 */
function profile_js() {
    ?>
<!-- wordpress3.1.4以下なら、下記が必要。使用中のjQuery1.7以上なら以下がなくても動く -->
<!--[if lt IE 9]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<![endif]-->

<script type="text/javascript">
    tftn = "table.form-table:nth-of-type";
    jQuery(document).ready(function() {
        jQuery("div#profile-page h3").css("display", "none");
        jQuery(tftn + "(1)").css("display", "none");
        jQuery(tftn + "(2)").css("display", "none");
//        jQuery(tftn + "(2) tr:nth-child(2)").css("display", "none");
//        jQuery(tftn + "(2) tr:nth-child(3)").css("display", "none");
//        jQuery(tftn + "(2) tr:nth-child(4)").css("display", "none");
        jQuery(tftn + "(2) tr:nth-child(5)").css("display", "none");
        jQuery(tftn + "(3)").css("display", "none");
//        jQuery(tftn + "(3) tr:nth-child(2)").css("display", "none");
        jQuery(tftn + "(4)").css("display", "none");
//        jQuery(tftn + "(4) tr:nth-child(1)").css("display", "none");
        jQuery(tftn + "(6)").css("display", "none");
    });
</script>
<?php }
//アクションフックshow_user_profileにこのスクリプトを組み込む
add_action( 'show_user_profile', 'profile_js' );

/*
 * Facebookボタンをカスタマイズ
 */
function _my_login_link_facebook($markup, $link, $title) {
    return '<a href="'.$link.'">'.$title.'</a>';
}
// add filter
add_filter('gianism_link_facebook', '_my_login_link_facebook', 10, 3);


/*
 * フッター削除
 */
function custom_admin_footer() {
    echo '';
}
add_filter('admin_footer_text', 'custom_admin_footer');


/*
 * ヘッダーに「ログアウト」を追加
 */
function add_new_item_in_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu( array(
        'id' => 'new_item_in_admin_bar',
        'title' => __('ログアウト'),
        'href' => wp_logout_url()
    ));
}
add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');


/*
 *
 */
function login_css() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo("template_directory").'/login.css">';
}
add_action('login_head', 'login_css');

