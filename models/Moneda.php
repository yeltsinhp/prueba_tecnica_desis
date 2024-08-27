<?php
require_once 'config/database.php';

class Moneda {
    private $conn;
    private $table_name = "moneda";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT id, nombre FROM " . $this->table_name . " WHERE status = 'active'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
