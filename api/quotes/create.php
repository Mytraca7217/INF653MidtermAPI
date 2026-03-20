<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quoteObj = new Quote($db);
$data = json_decode(file_get_contents("php://input"));

if (
    !isset($data->quote) ||
    !isset($data->author_id) ||
    !isset($data->category_id) ||
    empty(trim($data->quote))
) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$quoteObj->quote = $data->quote;
$quoteObj->author_id = (int)$data->author_id;
$quoteObj->category_id = (int)$data->category_id;


$checkAuthor = $db->prepare("SELECT id FROM authors WHERE id = :id");
$checkAuthor->bindParam(':id', $quoteObj->author_id);
$checkAuthor->execute();

if ($checkAuthor->rowCount() == 0) {
    echo json_encode(['message' => 'author_id Not Found']);
    exit();
}

if ($quoteObj->create()) {
    $quoteObj->read_single();

   echo json_encode([
    'id' => (int)$quoteObj->id,
    'quote' => $quoteObj->quote,
    'author_id' => (int)$quoteObj->author_id,
    'category_id' => (int)$quoteObj->category_id
]);
} else {
    echo json_encode(['message' => 'Quote Not Created']);
}
