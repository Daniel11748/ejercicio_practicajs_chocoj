<?php
require '../../models/vehiculo.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'] ?? null; 

try {
    $vehiculo = new vehiculo($_POST);

    switch ($metodo) {
        case 'POST':
            switch ($tipo) {
                case '1':
                    $ejecucion = $vehiculo->guardar();
                    $mensaje = "Guardado correctamente";
                    $codigo = 1;
                    break;
                    
                case '2':
                    $ejecucion = $vehiculo->modificar();
                    $mensaje = "Modificado correctamente";
                    $codigo = 2;
                    break;
                case '3':
                    $ejecucion = $vehiculo->eliminar();
                   
                    $mensaje = "Eliminado correctamente";
                    $codigo = 3;
                    break;
                default:
                    throw new Exception("Tipo de acción no válido");
            }
            http_response_code(200);
            echo json_encode([
                "mensaje" => $mensaje,
                "codigo" => $codigo,
            ]);
            break;
        case 'GET':
            http_response_code(200);
            $vehiculo = new vehiculo($_GET);
            $vehiculos = $vehiculo->buscar();
            echo json_encode($vehiculos);
            break;
        default:
            http_response_code(405);
            echo json_encode([
                "mensaje" => "Método no permitido",
                "codigo" => 9,
            ]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "detalle" => $e->getMessage(),
        "mensaje" => "Error de ejecución",
        "codigo" => 0,
    ]);
}