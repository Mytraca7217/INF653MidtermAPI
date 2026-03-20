<?php
header('Content-Type: application/json');

echo json_encode([
    'message' => 'INF653 Midterm API is running',
    'endpoints' => [
        '/api/authors/',
        '/api/categories/',
        '/api/quotes/'
    ]
]);
