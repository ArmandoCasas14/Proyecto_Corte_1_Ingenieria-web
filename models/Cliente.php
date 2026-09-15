<?php

require_once __DIR__ . '/../config/database.php';

class Cliente
{
    private $conexion;

    public function __construct()
    {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function registrar($documento, $nombre, $telefono)
    {
        $sql = "INSERT INTO clientes (documento, nombre, telefono)
                VALUES (:documento, :nombre, :telefono)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':documento' => $documento,
            ':nombre' => $nombre,
            ':telefono' => $telefono
        ]);

        return $this->conexion->lastInsertId();
    }

    public function consultar($id)
    {
        $sql = "SELECT * FROM clientes WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existe($id)
    {
        $sql = "SELECT id FROM clientes WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
}