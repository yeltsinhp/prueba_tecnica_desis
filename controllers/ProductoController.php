<?php
require_once 'models/Producto.php';
require_once 'models/Bodega.php';
require_once 'models/Sucursal.php';
require_once 'models/Moneda.php';
require_once 'models/Material.php';

class ProductoController {
    public function create() {
        $producto = new Producto();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $producto->codigo = $_POST['codigo'];
            $producto->nombre = $_POST['nombre'];
            $producto->bodega_id = $_POST['bodega'];
            $producto->sucursal_id = $_POST['sucursal'];
            $producto->moneda_id = $_POST['moneda'];
            $producto->precio = $_POST['precio'];
            $producto->descripcion = $_POST['descripcion'];
            $producto->materiales = $_POST['material'];

            if($producto->create()) {
                echo "Producto guardado con éxito.";
            } else {
                echo "Error al guardar el producto.";
            }
        }

        $bodega = new Bodega();
        $sucursal = new Sucursal();
        $moneda = new Moneda();
        $material = new Material();

        $bodegas = $bodega->getAll();
        $sucursales = $sucursal->getAll();
        $monedas = $moneda->getAll();
        $materiales = $material->getAll();

        require_once 'views/producto/form.php';
    }
}
