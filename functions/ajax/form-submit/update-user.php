<?php

// Hent bruger
$user = get_user_by('ID',esc_attr($_POST['user_id']));
if (!$user){
    $response['error'] = 'user not found';
    wp_die(json_encode($response));
}

// Opdater fornavn
$fname = $user->first_name;
if(isset($_POST['fname']) && '' !== $_POST['fname']){
    $fname = esc_attr($_POST['fname']);
}

// Opdater efternavn
$lname = $user->last_name;
if(isset($_POST['lname']) && '' !== $_POST['lname']){
    $lname = esc_attr($_POST['lname']);
}

// Opdater email
$email = $user->user_email;
if(isset($_POST['email']) && '' !== $_POST['email']){
    $email = esc_attr($_POST['email']);
}

$update =  wp_update_user(array(
    'ID' => $user->ID,
    'first_name' => $fname,
    'last_name' => $lname,
    'user_email' => $email,
));

if(is_wp_error($update)){
    $response['error'] = 'Error while updating user: ' . $update->get_error_message();
    wp_die(json_encode($response));
}



// Opdater password
if(isset($_POST['pass']) && isset($_POST['pass_2'])){
    if($_POST['pass'] !== '' && $_POST['pass'] === $_POST['pass_2']){
        wp_set_password(($_POST['pass']), esc_attr($_POST['user_id']));
        $signon = wp_signon(array(
            'user_login' => $user->user_login,
            'user_password' => $_POST['pass'],
            'remember' => 1,
        ));

        if(is_wp_error($signon)){
            $response['error'] = 'Error while setting pwd: ' . $signon->get_error_message();
            wp_die(json_encode($response));
        }
    }
}
