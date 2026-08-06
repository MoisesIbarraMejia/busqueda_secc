<?php
include __DIR__ . '/../modelo/conexion.php';

$objetoConexion = new Conexion();
$conexion = $objetoConexion->conectar();

try {

    //btener tipo
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

    if ($tipo === 'ubicacion') {
        $sqlUpdate = "UPDATE contador_busquedas SET conteo_ubi = COALESCE(conteo_ubi,0) + 1 WHERE id = 1";
    } elseif ($tipo === 'calle') {
        $sqlUpdate = "UPDATE contador_busquedas SET conteo_calle = COALESCE(conteo_calle,0) + 1 WHERE id = 1";
    } elseif ($tipo === 'fuera') {
    $sqlUpdate = "UPDATE contador_busquedas SET conteo_fuera_cobertura = COALESCE(conteo_fuera_cobertura,0) + 1 WHERE id = 1";
    } else {
        // contador general opcional
        $sqlUpdate = "UPDATE contador_busquedas SET contador = COALESCE(contador,0) + 1 WHERE id = 1";
    }

    $conexion->prepare($sqlUpdate)->execute();

    // Obtener valores actualizados
    $sqlSelect = "SELECT contador, conteo_ubi, conteo_calle, conteo_fuera_cobertura FROM contador_busquedas WHERE id = 1";
    $stmt = $conexion->prepare($sqlSelect);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($resultado);

} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

$conexion = null;
?>


