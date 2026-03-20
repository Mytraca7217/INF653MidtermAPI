<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quoteObj = new Quote($db);
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$quoteObj->id = (int)$data->id;

/* Check quote exists before delete */
$checkQuote = $db->prepare("SELECT id FROM quotes WHERE id = :id");
$checkQuote->bindParam(':id', $quoteObj->id, PDO::PARAM_INT);
$checkQuote->execute();

if ($checkQuote->rowCount() == 0) {
    echo json_encode(['message' => 'No Quotes Found']);
    exit();
}

if ($quoteObj->delete()) {
    echo json_encode(['id' => $quoteObj->id]);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
