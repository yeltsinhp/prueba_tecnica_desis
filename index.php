<?php
require_once 'controllers/ProductoController.php';

$controller = new ProductoController();
$action = isset($_GET['action']) ? $_GET['action'] : 'create';
$controller->$action();

$view = "views/producto/form.php";
require_once 'views/layout.php';
