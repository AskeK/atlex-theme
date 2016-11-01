<?php

function smamo_login_url(){
    $pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'templates/register.php', ));
    foreach($pages as $p){$u_href = get_permalink($p->ID);}
    return $u_href;
}

// Efter login
add_filter( 'login_redirect', 'smamo_login_redirect', 10, 3 );
function smamo_login_redirect( $redirect_to, $request, $user ) {
    return smamo_login_url();
}

// ved navigation til login
add_action('init','smamo_goto_login');
function smamo_goto_login() {
    $page = basename($_SERVER['REQUEST_URI']);
    if( $page == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_safe_redirect(smamo_login_url(), 301);
        exit;
    }
}

// Ved blanke credentials
add_filter( 'authenticate', 'smamo_blank_creds', 1, 3);
function smamo_blank_creds( $user, $username, $password ) {
    if( $username == "" || $password == "" ) {
        wp_safe_redirect(smamo_login_url(), 301);
        exit;
    }
}

// Ved login fejl
add_action( 'wp_login_failed', 'login_failed' );
function login_failed() {
    wp_safe_redirect(smamo_login_url(), 301);
    exit;
}

// Ved log ud
add_action('wp_logout', 'logout_page');
function logout_page() {
    wp_safe_redirect(get_bloginfo('url'), 301);
    exit;
}

