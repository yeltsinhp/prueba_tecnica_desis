<?php
require_once 'models/Producto.php';
require_once 'models/Bodega.php';
require_once 'models/Sucursal.php';
require_once 'models/Moneda.php';
require_once 'models/Material.php';
require_once 'validators/ProductoValidator.php';

class ProductoController
{
    private $productoModel;
    private $bodegaModel;
    private $sucursalModel;
    private $monedaModel;
    private $materialModel;

    public function __construct()
    {
        // Inicializa los modelos
        $this->productoModel = new Producto();
        $this->bodegaModel = new Bodega();
        $this->sucursalModel = new Sucursal();
        $this->monedaModel = new Moneda();
        $this->materialModel = new Material();
    }

    public function create()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'codigo' => trim($_POST['codigo']),
                'nombre' => trim($_POST['nombre']),
                'bodega_id' => $_POST['bodega'],
                'sucursal_id' => $_POST['sucursal'],
                'moneda_id' => $_POST['moneda'],
                'precio' => trim($_POST['precio']),
                'materiales' => isset($_POST['material']) ? $_POST['material'] : [],
                'descripcion' => trim($_POST['descripcion'])
            ];

            $errors = ProductoValidator::validate($data);

            if (empty($errors['codigo']) && $this->productoModel->findByCodigo($data['codigo'])) {
                $errors['codigo'] = "El código del producto ya existe. Por favor, elige otro.";
            }

            if (empty($errors)) {
                $productoId = $this->productoModel->create($data);

                if ($productoId) {
                    header('Location: index.php?action=create&success=1');
                    exit;
                } else {
                    $errors['general'] = "Error al guardar el producto. Por favor, intenta nuevamente.";
                }
            }

            $bodegas = $this->bodegaModel->getAll();
            $monedas = $this->monedaModel->getAll();
            $materiales = $this->materialModel->getAll();
            require_once 'views/producto/form.php';
        } else {
            $bodegas = $this->bodegaModel->getAll();
            $monedas = $this->monedaModel->getAll();
            $materiales = $this->materialModel->getAll();
            require_once 'views/producto/form.php';
        }
    }

    public function getSucursales()
    {
        if (isset($_GET['bodega_id'])) {
            $bodegaId = $_GET['bodega_id'];
            $sucursales = $this->sucursalModel->findByBodegaId($bodegaId);

            header('Content-Type: application/json');
            echo json_encode($sucursales);
            exit();
        } else {
            echo json_encode([]);
            exit();
        }
    }

    public function checkCodigo()
    {
        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];
            $producto = $this->productoModel->findByCodigo($codigo);

            header('Content-Type: application/json');
            echo json_encode(['exists' => $producto ? true : false]);
            exit();
        }
    }
}
