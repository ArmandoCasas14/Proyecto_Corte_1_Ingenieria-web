<?php

require_once __DIR__ . '/../config/database.php';

class Usuario
{
    private $conexion;

    public function __construct()
    {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function registrar($usuario, $contrasena, $estado)
    {
        $sql = "INSERT INTO usuarios (usuario, contrasena, estado)
                VALUES (:usuario, :contrasena, :estado)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':usuario' => $usuario,
            ':contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
            ':estado' => $estado
        ]);

        return $this->conexion->lastInsertId();
    }

    public function consultar($id)
    {
        $sql = "SELECT id, usuario, estado
                FROM usuarios
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listar()
    {
        $sql = "SELECT id, usuario, estado
                FROM usuarios";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $usuario, $estado)
    {
        $sql = "UPDATE usuarios
                SET usuario = :usuario,
                    estado = :estado
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':usuario' => $usuario,
            ':estado' => $estado
        ]);
    }

    public function existe($usuario)
    {
        $sql = "SELECT id, usuario, estado
                FROM usuarios
                WHERE usuario = :usuario";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':usuario' => $usuario
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}