<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoService
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }

    public function registrarProducto($codigo, $nombre, $precio, $estado)
    {
        try {
            $id = $this->producto->registrar(
                $codigo,
                $nombre,
                $precio,
                $estado
            );

            return "Producto registrado correctamente. ID: " . $id;

        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
            return "Error: el código del producto ya existe.";
        }
        
        // Si es otro tipo de error, devuélvelo para saber qué pasó
        return "Error en base de datos: " . $e->getMessage();
        }
    }

    public function consultarProducto($id)
    {
        $producto = $this->producto->consultar($id);

        if (!$producto) {
            return "Error: el producto no existe.";
        }

        return $producto;
    }

    public function listarProductos()
    {
        return $this->producto->listar();
    }

    public function actualizarProducto($id, $nombre, $precio, $estado)
    {
        $producto = $this->producto->consultar($id);

        if (!$producto) {
            return "Error: el producto no existe.";
        }

        $resultado = $this->producto->actualizar(
            $id,
            $nombre,
            $precio,
            $estado
        );

        if ($resultado) {
            return "Producto actualizado correctamente.";
        }

        return "Error: no se pudo actualizar el producto.";
    }
}