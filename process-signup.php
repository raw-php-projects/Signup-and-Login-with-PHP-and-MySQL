<?php

# Check if name is not empty - Done
# Validate Email - Done
# Password should be grater than 8 - Done
# Contain a-z/0-9 - Done
# Check both password is same - Done
# Password Hash - Done
# Create Database and Table - Done
# Connect to the databse - Done
# Insert user to the database

// Check if name is empty
if ( empty( $_POST['name'] ) ) {
    die( 'Name is required' );
}

// Check if email is valid
if( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ){
    die( 'Invalid email address' );
}

// Check password lenght
if (strlen( $_POST['password']) < 8 ) {
    die('Password should be 8 charecter long');
}

// Check if password contain letter
if ( ! preg_match( '/[a-z]/i', $_POST['password'] ) ) {
    die('Password must contain at least one letter');
}

// Check if password contain number
if ( ! preg_match( '/[0-9]/', $_POST['password'] ) ) {
    die('Password must contain at least one number');
}

// Check if password and confirm password match
if ( $_POST['password'] !== $_POST['password_confirmation'] ) {
    die('Password didn\'t match');
}

// Data
$name = htmlspecialchars($_POST['name']);
$email = $_POST['email'];
$password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Require Database connection
require_once "database.php";

// Query and Insert Users to database
$sql = "INSERT INTO users(`name`, `email`, `password_hash`)
        VALUES(?,?,?)";

$stmt = $mysqli->stmt_init();

if( ! $stmt->prepare($sql) ){
    die( 'SQL error:' . $mysqli->error );
}

$stmt->bind_param( "sss", $name, $email, $password_hash );

// Redirect if success other wise show the error
if( $stmt->execute() ){
    header("Location: signup-success.html" );
}else{
    if( $mysqli->errno === 1062 ){
        die( "Email already taken" );
    }

    die( $mysqli->error . " " . $mysqli->errno );
}

$stmt->close();
$mysqli->close();