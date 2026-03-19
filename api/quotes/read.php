<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quoteObj = new Quote($db);

$author_id = isset($_GET['author_id']) ? (int)$_GET['author_id'] : null;
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

$result = $quoteObj->read($author_id, $category_id);

$quotes_arr = [];

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $quotes_arr[] = [
        'id' => (int)$row['id'],
        'quote' => $row['quote'],
        'author' => $row['author'],
        'category' => $row['category']
    ];
}

echo json_encode($quotes_arr);