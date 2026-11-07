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
            $usuarios = $this->usuario->listar();

        $respuesta = [
            'exito' => true,
            'mensaje' => 'Usuarios consultados correctamente.',
            'usuarios' => []
        ];

        foreach ($usuarios as $usuario) {
            $respuesta['usuarios'][] = [
                'id' => (int) $usuario['id'],
                'usuario' => $usuario['usuario'],
                'estado' => (int) $usuario['estado']
            ];
        }

        return $respuesta;
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