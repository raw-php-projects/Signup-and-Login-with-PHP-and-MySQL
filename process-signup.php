<?php

# Check if name is not empty - Done
# Validate Email - Done
# Password should be grater than 8 - Done
# Contain a-z/0-9 - Done
# Check both password is same 

if ( empty( $_POST['name'] ) ) {
    die( 'Name is required' );
}

if( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ){
    die( 'Invalid email address' );
}

if ( ! preg_match( '/[a-z]/i', $_POST['password'] ) ) {
    die('Password must contain at least one letter');
}

if ( ! preg_match( '/[0-9]/', $_POST['password'] ) ) {
    die('Password must contain at least one number');
}

if ( $_POST['password'] !== $_POST['password_confirmation'] ) {
    die('Passwords must match');
}

print_r($_POST);