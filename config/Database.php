<?php
class Database {
    private $conn;
    private $host;
    private $port;
    private $db_name;
    private $username;
    private $password;

    public function __construct() {
        $this->host = getenv('HOST') ?: 'localhost';
        $this->port = getenv('PORT_DB') ?: '4533';
        $this->db_name = getenv('DBNAME') ?: 'quotesdb';
        $this->username = getenv('USERNAME') ?: 'postgres';
        $this->password = getenv('PASSWORD') ?: 'postgres';
    }

    public function connect() {
        $this->conn = null;

        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection Error: ' . $e->getMessage());
        }

        return $this->conn;
    }
}
