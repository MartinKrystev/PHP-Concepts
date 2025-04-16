<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 3;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

// passing the DB data to the view
$errors = [];
view("/notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => $errors,
    'note' => $note
]);

