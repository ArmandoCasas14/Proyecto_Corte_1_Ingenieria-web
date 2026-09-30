<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Cliente.php';

class Pedido
{
    private $conexion;

    public function __construct()
    {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function registrar($producto_id, $cliente_id, $cantidad, $fecha, $estado)
    {
        // Validar cantidad
        if ($cantidad < 0) {
            return "Error: la cantidad debe ser mayor que cero.";
        }

        // Verificar que el cliente exista
        $cliente = new Cliente();

        if (!$cliente->existe($cliente_id)) {
            return "Error: el cliente no existe.";
        }

        // Verificar que el producto exista y esté activo
        $sql = "SELECT id FROM productos
                WHERE id = :producto_id
                AND estado = 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':producto_id' => $producto_id
        ]);

        if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
            return "Error: el producto no existe o está inactivo.";
        }

        // Registrar pedido
        $sql = "INSERT INTO pedidos
                (producto_id, cliente_id, cantidad, fecha, estado)
                VALUES
                (:producto_id, :cliente_id, :cantidad, :fecha, :estado)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':producto_id' => $producto_id,
            ':cliente_id' => $cliente_id,
            ':cantidad' => $cantidad,
            ':fecha' => $fecha,
            ':estado' => $estado
        ]);

        return "Pedido registrado correctamente. ID: " .
               $this->conexion->lastInsertId();
    }

    public function listar()
    {
        $sql = "SELECT
                    pedidos.id,
                    productos.nombre AS producto,
                    clientes.nombre AS cliente,
                    pedidos.cantidad,
                    pedidos.fecha,
                    pedidos.estado
                FROM pedidos
                INNER JOIN productos
                    ON pedidos.producto_id = productos.id
                INNER JOIN clientes
                    ON pedidos.cliente_id = clientes.id";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}