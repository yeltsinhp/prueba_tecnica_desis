<?php
require_once 'models/Producto.php';
require_once 'models/Bodega.php';
require_once 'models/Sucursal.php';
require_once 'models/Moneda.php';
require_once 'models/Material.php';

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
        // Verifica si el formulario fue enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoge los datos del formulario
            $codigo = trim($_POST['codigo']);
            $nombre = trim($_POST['nombre']);
            $bodegaId = $_POST['bodega'];
            $sucursalId = $_POST['sucursal'];
            $monedaId = $_POST['moneda'];
            $precio = trim($_POST['precio']);
            $materiales = isset($_POST['material']) ? $_POST['material'] : [];
            $descripcion = trim($_POST['descripcion']);

            // Validaciones
            $errors = [];

            // Validación del código
            if (empty($codigo) || !preg_match('/^[A-Za-z0-9]+$/', $codigo) || strlen($codigo) < 5 || strlen($codigo) > 15) {
                $errors[] = "El código del producto es inválido. Debe tener entre 5 y 15 caracteres alfanuméricos.";
            } elseif ($this->productoModel->findByCodigo($codigo)) {
                $errors[] = "El código del producto ya existe. Por favor, elige otro.";
            }

            // Validación del nombre
            if (empty($nombre) || strlen($nombre) < 2 || strlen($nombre) > 50) {
                $errors[] = "El nombre del producto debe tener entre 2 y 50 caracteres.";
            }

            // Validación del precio
            if (empty($precio) || !preg_match('/^\d+(\.\d{1,2})?$/', $precio) || $precio <= 0) {
                $errors[] = "El precio del producto es inválido. Debe ser un número positivo con hasta dos decimales.";
            }

            // Validación de los materiales
            if (count($materiales) < 2) {
                $errors[] = "Debe seleccionar al menos dos materiales.";
            }

            // Validación de la descripción
            if (empty($descripcion) || strlen($descripcion) < 10 || strlen($descripcion) > 1000) {
                $errors[] = "La descripción del producto debe tener entre 10 y 1000 caracteres.";
            }

            // Si no hay errores, guardar el producto
            if (empty($errors)) {
                $data = [
                    'codigo' => $codigo,
                    'nombre' => $nombre,
                    'bodega_id' => $bodegaId,
                    'sucursal_id' => $sucursalId,
                    'moneda_id' => $monedaId,
                    'precio' => $precio,
                    'descripcion' => $descripcion,
                    'materiales' => $materiales
                ];

                $productoId = $this->productoModel->create($data);

                if ($productoId) {
                    // Redirigir con un mensaje de éxito
                    header('Location: index.php?action=create&success=1');
                    exit;
                } else {
                    $errors[] = "Error al guardar el producto. Por favor, intenta nuevamente.";
                }
            }

            // Si hay errores, mostrar el formulario con los errores
            $bodegas = $this->bodegaModel->getAll();
            $monedas = $this->monedaModel->getAll();
            $materiales = $this->materialModel->getAll();
            require_once 'views/producto/form.php';
        } else {
            // Mostrar el formulario con los datos necesarios
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

            // Asegúrate de que no haya salida previa
            header('Content-Type: application/json');
            echo json_encode($sucursales);
            exit();  // Termina el script para evitar contenido adicional
        } else {
            // Devuelve un array vacío si no hay bodega_id
            echo json_encode([]);
            exit();
        }
    }
}
