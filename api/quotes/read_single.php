<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quoteObj = new Quote($db);

if (!isset($_GET['id'])) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$quoteObj->id = (int)$_GET['id'];

if ($quoteObj->read_single()) {
    echo json_encode([
        'id' => (int)$quoteObj->id,
        'quote' => $quoteObj->quote,
        'author' => $quoteObj->author,
        'category' => $quoteObj->category
    ]);
} else {
    echo json_encode(['message' => 'quote_id Not Found']);
}