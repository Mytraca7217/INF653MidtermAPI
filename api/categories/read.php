<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);
$result = $category->read();

$arr = [];

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $arr[] = [
        'id' => (int)$row['id'],
        'category' => $row['category']
    ];
}

echo json_encode($arr);