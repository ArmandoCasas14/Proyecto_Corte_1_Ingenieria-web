<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClienteService
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function registrarCliente($documento, $nombre, $telefono)
    {
        try {
            $id = $this->cliente->registrar(
                $documento,
                $nombre,
                $telefono
            );

            return "Cliente registrado correctamente. ID: " . $id;

        } catch (PDOException $e) {
            return "Error: el documento del cliente ya existe.";
        }
    }

    public function consultarCliente($id)
    {
        $cliente = $this->cliente->consultar($id);

        if (!$cliente) {
            return "Error: el cliente no existe.";
        }

        return $cliente;
    }
}