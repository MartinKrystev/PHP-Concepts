<?php

use Core\Validator;
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required!';
}

if (!empty($errors)) {
    //validation issue, redirect back to /notes
    view("/notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}
$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 3
]);

//redirecting after the successful store into DB
header('Location: /notes');
die();
