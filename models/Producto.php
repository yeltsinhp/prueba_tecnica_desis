<?php
require_once 'config/database.php';

class Producto {
    private $conn;
    private $table_name = "productos";

    public $id;
    public $codigo;
    public $nombre;
    public $bodega_id;
    public $sucursal_id;
    public $moneda_id;
    public $precio;
    public $descripcion;
    public $materiales = [];

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
            (codigo, nombre, bodega_id, sucursal_id, moneda_id, precio, descripcion) 
            VALUES (:codigo, :nombre, :bodega_id, :sucursal_id, :moneda_id, :precio, :descripcion)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":bodega_id", $this->bodega_id);
        $stmt->bindParam(":sucursal_id", $this->sucursal_id);
        $stmt->bindParam(":moneda_id", $this->moneda_id);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":descripcion", $this->descripcion);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            $this->saveMaterials();
            return true;
        }

        return false;
    }

    private function saveMaterials() {
        if (!empty($this->materiales)) {
            foreach ($this->materiales as $material_id) {
                $query = "INSERT INTO producto_material (producto_id, material_id) VALUES (:producto_id, :material_id)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":producto_id", $this->id);
                $stmt->bindParam(":material_id", $material_id);
                $stmt->execute();
            }
        }
    }

    public function getAll() {
        $query = "SELECT p.*, b.nombre AS bodega_nombre, s.nombre AS sucursal_nombre, m.nombre AS moneda_nombre
                  FROM " . $this->table_name . " p
                  JOIN bodega b ON p.bodega_id = b.id
                  JOIN sucursal s ON p.sucursal_id = s.id
                  JOIN moneda m ON p.moneda_id = m.id
                  WHERE p.status = 'active'";

        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
