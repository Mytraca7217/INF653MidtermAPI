<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$authorObj = new Author($db);
$authorObj->id = isset($_GET['id']) ? (int)$_GET['id'] : die();

if ($authorObj->read_single()) {
    $author_arr = [
        'id' => (int)$authorObj->id,
        'author' => $authorObj->author
    ];

    echo json_encode($author_arr);
} else {
    echo json_encode(['message' => 'author_id Not Found']);
}