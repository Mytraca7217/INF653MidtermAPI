<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

if (!isset($_GET['id'])) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$category->id = (int)$_GET['id'];

if ($category->read_single()) {
    echo json_encode([
        'id' => $category->id,
        'category' => $category->category
    ]);
} else {
    echo json_encode(['message' => 'category_id Not Found']);
}