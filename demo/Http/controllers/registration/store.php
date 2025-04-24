<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST["email"];
$password = $_POST["password"];

$errors = [];
// validate email
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
};

// validate password
if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a valid password of at least 7 characters';
};

// check for validation errors
if (!empty($errors)) {
    view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

// check if the account exists
$user = $db->query('SELECT * FROM users WHERE email =  :email', [
    'email' => $email
])->find();

if ($user) {
    // the user exists -> redirect to the login page
    header('location: /register');
    exit();
} else {
    // the user does NOT exist -> save to DB
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark the user has logged in - extracted into a function
//    $_SESSION['user'] = [
//        'email' => $email
//    ];
    login([
        $email => $email
    ]);

    // redirect to the home page
    header('location: /');
    exit();
}