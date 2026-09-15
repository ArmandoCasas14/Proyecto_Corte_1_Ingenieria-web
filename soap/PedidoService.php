<?php

require_once __DIR__ . '/../models/Pedido.php';

class PedidoService
{
    private $pedido;

    public function __construct()
    {
        $this->pedido = new Pedido();
    }

    public function registrarPedido($producto_id, $cliente_id, $cantidad, $fecha)
    {
        // Estado inicial del pedido
        $estado = "pendiente";

        return $this->pedido->registrar(
            $producto_id,
            $cliente_id,
            $cantidad,
            $fecha,
            $estado
        );
    }

    public function consultarPedidos()
    {
        return $this->pedido->listar();
    }
}