<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/Database.php';

$database = new Database();
$db = $database->connect();

if ($db) {
    echo "Connected successfully!";
} else {
    echo "Connection failed.";
}