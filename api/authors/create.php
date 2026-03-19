<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$authorObj = new Author($db);
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->author) || empty(trim($data->author))) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$authorObj->author = $data->author;

if ($authorObj->create()) {
    echo json_encode([
        'id' => (int)$authorObj->id,
        'author' => $authorObj->author
    ]);
} else {
    echo json_encode(['message' => 'Author Not Created']);
}