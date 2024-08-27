<?php
require_once 'config/database.php';

class Sucursal {
    private $conn;
    private $table_name = "sucursal";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function findByBodegaId($bodegaId) {
        $query = "SELECT * FROM sucursal WHERE bodega_id = :bodega_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":bodega_id", $bodegaId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
