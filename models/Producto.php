<?php

require_once __DIR__ . '/../config/database.php';

class Producto
{
    private $conexion;

    public function __construct()
    {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function registrar($codigo, $nombre, $precio, $estado)
    {
        // Conversión robusta para evitar que llegue un string vacío o formato incorrecto de SOAP
        if ($estado === false || $estado === 'false' || $estado === '0' || $estado === '' || $estado === null) {
            $estado = 0;
        } else {
            $estado = 1;
        }

        $sql = "INSERT INTO productos (codigo, nombre, precio, estado)
                VALUES (:codigo, :nombre, :precio, :estado)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':codigo' => $codigo,
            ':nombre' => $nombre,
            ':precio' => $precio,
            ':estado' => $estado
        ]);

        return $this->conexion->lastInsertId();
    }

    public function consultar($id)
    {
        $sql = "SELECT * FROM productos WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listar()
    {
        $sql = "SELECT * FROM productos";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $precio, $estado)
    {
        $sql = "UPDATE productos
                SET nombre = :nombre,
                    precio = :precio,
                    estado = :estado
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':precio' => $precio,
            ':estado' => $estado
        ]);
    }
}