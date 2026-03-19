<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$authorObj = new Author($db);
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$authorObj->id = (int)$data->id;

if ($authorObj->delete()) {
    echo json_encode(['id' => $authorObj->id]);
} else {
    echo json_encode(['message' => 'Author Not Deleted']);
}