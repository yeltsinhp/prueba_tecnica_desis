<?php

class ProductoValidator {
    
    public static function validate($data) {
        $errors = [];

        if (empty($data['codigo']) || !preg_match('/^[A-Za-z0-9]+$/', $data['codigo']) || strlen($data['codigo']) < 5 || strlen($data['codigo']) > 15) {
            $errors['codigo'] = "El código del producto es inválido. Debe tener entre 5 y 15 caracteres alfanuméricos.";
        }

        if (empty($data['nombre']) || strlen($data['nombre']) < 2 || strlen($data['nombre']) > 50) {
            $errors['nombre'] = "El nombre del producto debe tener entre 2 y 50 caracteres.";
        }

        if (empty($data['precio']) || !preg_match('/^\d+(\.\d{1,2})?$/', $data['precio']) || $data['precio'] <= 0) {
            $errors['precio'] = "El precio del producto es inválido. Debe ser un número positivo con hasta dos decimales.";
        }

        if (count($data['materiales']) < 2) {
            $errors['materiales'] = "Debe seleccionar al menos dos materiales.";
        }

        if (empty($data['descripcion']) || strlen($data['descripcion']) < 10 || strlen($data['descripcion']) > 1000) {
            $errors['descripcion'] = "La descripción del producto debe tener entre 10 y 1000 caracteres.";
        }

        return $errors;
    }
}
