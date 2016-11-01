<?php

add_action( 'wp_login_failed', 'smamo_login_fails' );
function smamo_login_fails( $username ) {
     $referrer = $_SERVER['HTTP_REFERER'];
     if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
          wp_redirect(home_url() . '/login/?l=0' );
          exit;
     }
}
