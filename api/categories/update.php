<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);
$data = json_decode(file_get_contents("php://input"));

if (
    !isset($data->id) ||
    !isset($data->category) ||
    empty(trim($data->category))
) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$category->id = (int)$data->id;
$category->category = $data->category;

if ($category->update()) {
    echo json_encode([
        'id' => $category->id,
        'category' => $category->category
    ]);
} else {
    echo json_encode(['message' => 'Category Not Updated']);
}