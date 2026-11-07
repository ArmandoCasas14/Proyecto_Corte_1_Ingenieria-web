<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/ProductoService.php';
require_once __DIR__ . '/ClienteService.php';
require_once __DIR__ . '/PedidoService.php';
require_once __DIR__ . '/UsuarioService.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

$server = new nusoap_server();

$server->configureWSDL(
    'RestauranteService',
    'urn:RestauranteService'
);

$server->wsdl->schemaTargetNamespace = 'urn:RestauranteService';


// =====================================
// TIPOS DE DATOS
// =====================================

// Producto
$server->wsdl->addComplexType(
    'Producto',
    'complexType',
    'struct',
    'all',
    '',
    [
        'id' => [
            'name' => 'id',
            'type' => 'xsd:int'
        ],
        'codigo' => [
            'name' => 'codigo',
            'type' => 'xsd:string'
        ],
        'nombre' => [
            'name' => 'nombre',
            'type' => 'xsd:string'
        ],
        'precio' => [
            'name' => 'precio',
            'type' => 'xsd:decimal'
        ],
        'estado' => [
            'name' => 'estado',
            'type' => 'xsd:boolean'
        ]
    ]
);


// Lista de productos
$server->wsdl->addComplexType(
    'ListaProductos',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    [
        'item' => [
            'name' => 'item',
            'type' => 'tns:Producto',
            'minOccurs' => '0',
            'maxOccurs' => 'unbounded'
        ]
    ]
);


// Cliente
$server->wsdl->addComplexType(
    'Cliente',
    'complexType',
    'struct',
    'all',
    '',
    [
        'id' => [
            'name' => 'id',
            'type' => 'xsd:int'
        ],
        'documento' => [
            'name' => 'documento',
            'type' => 'xsd:string'
        ],
        'nombre' => [
            'name' => 'nombre',
            'type' => 'xsd:string'
        ],
        'telefono' => [
            'name' => 'telefono',
            'type' => 'xsd:string'
        ]
    ]
);


// Pedido
$server->wsdl->addComplexType(
    'Pedido',
    'complexType',
    'struct',
    'all',
    '',
    [
        'id' => [
            'name' => 'id',
            'type' => 'xsd:int'
        ],
        'producto' => [
            'name' => 'producto',
            'type' => 'xsd:string'
        ],
        'cliente' => [
            'name' => 'cliente',
            'type' => 'xsd:string'
        ],
        'cantidad' => [
            'name' => 'cantidad',
            'type' => 'xsd:int'
        ],
        'fecha' => [
            'name' => 'fecha',
            'type' => 'xsd:string'
        ],
        'estado' => [
            'name' => 'estado',
            'type' => 'xsd:string'
        ]
    ]
);


// Lista de pedidos
$server->wsdl->addComplexType(
    'ListaPedidos',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    [
        'item' => [
            'name' => 'item',
            'type' => 'tns:Pedido',
            'minOccurs' => '0',
            'maxOccurs' => 'unbounded'
        ]
    ]
);
// Usuario
$server->wsdl->addComplexType(
    'Usuario',
    'complexType',
    'struct',
    'all',
    '',
    [
        'id' => [
            'name' => 'id',
            'type' => 'xsd:int'
        ],
        'usuario' => [
            'name' => 'usuario',
            'type' => 'xsd:string'
        ],
        'estado' => [
            'name' => 'estado',
            'type' => 'xsd:boolean'
        ]
    ]
);// Usuario
$server->wsdl->addComplexType(
    'Usuario',
    'complexType',
    'struct',
    'all',
    '',
    [
        'id' => [
            'name' => 'id',
            'type' => 'xsd:int'
        ],
        'usuario' => [
            'name' => 'usuario',
            'type' => 'xsd:string'
        ],
        'estado' => [
            'name' => 'estado',
            'type' => 'xsd:boolean'
        ]
    ]
);
// Usuario
$server->wsdl->addComplexType(
    'Usuario',
    'complexType',
    'struct',
    'all',
    '',
    [
        'id' => [
            'name' => 'id',
            'type' => 'xsd:int'
        ],
        'usuario' => [
            'name' => 'usuario',
            'type' => 'xsd:string'
        ],
        'estado' => [
            'name' => 'estado',
            'type' => 'xsd:boolean'
        ]
    ]
);
// Lista de usuarios
$server->wsdl->addComplexType(
    'ListaUsuarios',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    [
        'item' => [
            'name' => 'item',
            'type' => 'tns:Usuario',
            'minOccurs' => '0',
            'maxOccurs' => 'unbounded'
        ]
    ]
);
// =====================================
// PRODUCTOS
// =====================================

$server->register(
    'registrarProducto',
    [
        'codigo' => 'xsd:string',
        'nombre' => 'xsd:string',
        'precio' => 'xsd:decimal',
        'estado' => 'xsd:boolean'
    ],
    ['return' => 'xsd:string'],
    'urn:RestauranteService',
    'urn:RestauranteService#registrarProducto',
    'rpc',
    'encoded',
    'Registra un producto'
);

$server->register(
    'consultarProducto',
    ['id' => 'xsd:int'],
    ['return' => 'tns:Producto'],
    'urn:RestauranteService',
    'urn:RestauranteService#consultarProducto',
    'rpc',
    'encoded',
    'Consulta un producto'
);

$server->register(
    'listarProductos',
    [],
    ['return' => 'tns:ListaProductos'],
    'urn:RestauranteService',
    'urn:RestauranteService#listarProductos',
    'rpc',
    'encoded',
    'Lista todos los productos'
);

$server->register(
    'actualizarProducto',
    [
        'id' => 'xsd:int',
        'nombre' => 'xsd:string',
        'precio' => 'xsd:decimal',
        'estado' => 'xsd:boolean'
    ],
    ['return' => 'xsd:string'],
    'urn:RestauranteService',
    'urn:RestauranteService#actualizarProducto',
    'rpc',
    'encoded',
    'Actualiza un producto'
);


// =====================================
// CLIENTES
// =====================================

$server->register(
    'registrarCliente',
    [
        'documento' => 'xsd:string',
        'nombre' => 'xsd:string',
        'telefono' => 'xsd:string'
    ],
    ['return' => 'xsd:string'],
    'urn:RestauranteService',
    'urn:RestauranteService#registrarCliente',
    'rpc',
    'encoded',
    'Registra un cliente'
);

$server->register(
    'consultarCliente',
    ['id' => 'xsd:int'],
    ['return' => 'tns:Cliente'],
    'urn:RestauranteService',
    'urn:RestauranteService#consultarCliente',
    'rpc',
    'encoded',
    'Consulta un cliente'
);
// =====================================
// USUARIOS
// =====================================

$server->register(
    'registrarUsuario',
    [
        'usuario' => 'xsd:string',
        'contrasena' => 'xsd:string',
        'estado' => 'xsd:boolean'
    ],
    ['return' => 'xsd:string'],
    'urn:RestauranteService',
    'urn:RestauranteService#registrarUsuario',
    'rpc',
    'encoded',
    'Registra un usuario'
);

$server->register(
    'consultarUsuario',
    ['id' => 'xsd:int'],
    ['return' => 'tns:Usuario'],
    'urn:RestauranteService',
    'urn:RestauranteService#consultarUsuario',
    'rpc',
    'encoded',
    'Consulta un usuario'
);

$server->register(
    'listarUsuarios',
    [],
    ['return' => 'tns:ListaUsuarios'],
    'urn:RestauranteService',
    'urn:RestauranteService#listarUsuarios',
    'rpc',
    'encoded',
    'Lista todos los usuarios'
);

$server->register(
    'actualizarUsuario',
    [
        'id' => 'xsd:int',
        'usuario' => 'xsd:string',
        'estado' => 'xsd:boolean'
    ],
    ['return' => 'xsd:string'],
    'urn:RestauranteService',
    'urn:RestauranteService#actualizarUsuario',
    'rpc',
    'encoded',
    'Actualiza un usuario'
);

// =====================================
// PEDIDOS
// =====================================

$server->register(
    'registrarPedido',
    [
        'producto_id' => 'xsd:int',
        'cliente_id' => 'xsd:int',
        'cantidad' => 'xsd:int',
        'fecha' => 'xsd:string'
    ],
    ['return' => 'xsd:string'],
    'urn:RestauranteService',
    'urn:RestauranteService#registrarPedido',
    'rpc',
    'encoded',
    'Registra un pedido'
);

$server->register(
    'consultarPedidos',
    [],
    ['return' => 'tns:ListaPedidos'],
    'urn:RestauranteService',
    'urn:RestauranteService#consultarPedidos',
    'rpc',
    'encoded',
    'Consulta todos los pedidos'
);


// =====================================
// FUNCIONES DE PRODUCTOS
// =====================================

function registrarProducto($codigo, $nombre, $precio, $estado)
{
    $service = new ProductoService();

    return $service->registrarProducto(
        $codigo,
        $nombre,
        $precio,
        $estado
    );
}

function consultarProducto($id)
{
    $service = new ProductoService();

    return $service->consultarProducto($id);
}

function listarProductos()
{
    $service = new ProductoService();

    return $service->listarProductos();
}

function actualizarProducto($id, $nombre, $precio, $estado)
{
    $service = new ProductoService();

    return $service->actualizarProducto(
        $id,
        $nombre,
        $precio,
        $estado
    );
}


// =====================================
// FUNCIONES DE CLIENTES
// =====================================

function registrarCliente($documento, $nombre, $telefono)
{
    $service = new ClienteService();

    return $service->registrarCliente(
        $documento,
        $nombre,
        $telefono
    );
}

function consultarCliente($id)
{
    $service = new ClienteService();

    return $service->consultarCliente($id);
}


// =====================================
// FUNCIONES DE PEDIDOS
// =====================================

function registrarPedido($producto_id, $cliente_id, $cantidad, $fecha)
{
    $service = new PedidoService();

    return $service->registrarPedido(
        $producto_id,
        $cliente_id,
        $cantidad,
        $fecha
    );
}

function consultarPedidos()
{
    $service = new PedidoService();

    return $service->consultarPedidos();
}

// =====================================
// FUNCIONES DE USUARIOS
// =====================================

function registrarUsuario($usuario, $contrasena, $estado)
{
    $service = new UsuarioService();

    return $service->registrarUsuario(
        $usuario,
        $contrasena,
        $estado
    );
}

function consultarUsuario($id)
{
    $service = new UsuarioService();

    return $service->consultarUsuario($id);
}

function listarUsuarios()
{
    $service = new UsuarioService();

    return $service->listarUsuarios();
}

function actualizarUsuario($id, $usuario, $estado)
{
    $service = new UsuarioService();

    return $service->actualizarUsuario(
        $id,
        $usuario,
        $estado
    );
}
function validarUsuarioSOAP($server)
{
    require_once __DIR__ . '/../src/Auth/JwtValidator.php';

    // Obtener el Header SOAP
    $header = $server->requestHeader;

    // Verificar que exista el Header
    if (
        !$header ||
        !isset($header['Security']['BearerToken'])
    ) {
        $server->fault(
            'Authentication',
            'No se encontro el token JWT en el Header SOAP.'
        );

        return false;
    }

    // Obtener el JWT
    $token = $header['Security']['BearerToken'];

    try {

        // Validar el token generado por Laravel
        \App\Auth\JwtValidator::validate($token);

        // Token válido
        return true;

    } catch (\Throwable $e) {

        $server->fault(
            'Authentication',
            'El token JWT es invalido o ha expirado.'
        );

        return false;
    }
}
// =====================================
// PROCESAR PETICIÓN SOAP
// =====================================

$HTTP_RAW_POST_DATA = file_get_contents("php://input");

if (isset($_GET['wsdl'])) {

    $server->service($HTTP_RAW_POST_DATA);

} else {

    // Analizar la petición SOAP
    $server->parse_request($HTTP_RAW_POST_DATA);

    // Validar el usuario del Header
    if (validarUsuarioSOAP($server)) {

        // Ejecutar la operación SOAP
        $server->invoke_method();

        // Generar la respuesta
        if (!$server->fault) {
            $server->serialize_return();
        }
    }

    // Enviar la respuesta
    $server->send_response();
}