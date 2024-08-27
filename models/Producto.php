<?php
require_once 'config/database.php';

class Producto
{
    private $conn;
    private $table_name = "productos";

    public $id;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " 
            (codigo, nombre, bodega_id, sucursal_id, moneda_id, precio, descripcion, status, created_at, updated_at) 
            VALUES (:codigo, :nombre, :bodega_id, :sucursal_id, :moneda_id, :precio, :descripcion, 'active', NOW(), NOW())";

        $stmt = $this->conn->prepare($query);

        // Asignar los valores pasados desde el controlador
        $stmt->bindParam(":codigo", $data['codigo']);
        $stmt->bindParam(":nombre", $data['nombre']);
        $stmt->bindParam(":bodega_id", $data['bodega_id']);
        $stmt->bindParam(":sucursal_id", $data['sucursal_id']);
        $stmt->bindParam(":moneda_id", $data['moneda_id']);
        $stmt->bindParam(":precio", $data['precio']);
        $stmt->bindParam(":descripcion", $data['descripcion']);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            $this->saveMaterials($this->id, $data['materiales']);
            return $this->id; // Devolver el ID del producto creado
        }

        return false;
    }

    private function saveMaterials($productoId, $materiales)
    {
        if (!empty($materiales)) {
            foreach ($materiales as $material_id) {
                $this->addMaterialToProducto($productoId, $material_id);
            }
        }
    }

    public function addMaterialToProducto($productoId, $material_id)
    {
        $query = "INSERT INTO producto_material (producto_id, material_id) VALUES (:producto_id, :material_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":producto_id", $productoId);
        $stmt->bindParam(":material_id", $material_id);
        $stmt->execute();
    }

    public function getAll()
    {
        $query = "SELECT p.*, b.nombre AS bodega_nombre, s.nombre AS sucursal_nombre, m.nombre AS moneda_nombre
                  FROM " . $this->table_name . " p
                  JOIN bodega b ON p.bodega_id = b.id
                  JOIN sucursal s ON p.sucursal_id = s.id
                  JOIN moneda m ON p.moneda_id = m.id
                  WHERE p.status = 'active'";

        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCodigo($codigo)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE codigo = :codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el producto si existe, o false si no
    }
}
