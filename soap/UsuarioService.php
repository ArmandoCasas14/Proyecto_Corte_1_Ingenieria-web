<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioService
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function registrarUsuario($usuario, $contrasena, $estado)
    {
        try {
            $id = $this->usuario->registrar(
                $usuario,
                $contrasena,
                $estado
            );

            return "Usuario registrado correctamente. ID: " . $id;

        } catch (PDOException $e) {
            return "Error: el usuario ya existe.";
        }
    }

    public function consultarUsuario($id)
    {
        $usuario = $this->usuario->consultar($id);

        if (!$usuario) {
            return "Error: el usuario no existe.";
        }

        return $usuario;
    }

    public function listarUsuarios()
    {
        return $this->usuario->listar();
    }

    public function actualizarUsuario($id, $usuario, $estado)
    {
        $usuarioExistente = $this->usuario->consultar($id);

        if (!$usuarioExistente) {
            return "Error: el usuario no existe.";
        }

        $resultado = $this->usuario->actualizar(
            $id,
            $usuario,
            $estado
        );

        if ($resultado) {
            return "Usuario actualizado correctamente.";
        }

        return "Error: no se pudo actualizar el usuario.";
    }
}