<?php
require_once 'controllers/ProductoController.php';

$controller = new ProductoController();
$action = isset($_GET['action']) ? $_GET['action'] : 'create';

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "Acción no encontrada.";
}

$view = "views/producto/form.php";
require_once 'views/layout.php';
