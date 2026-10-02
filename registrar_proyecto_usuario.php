<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_usuario.php");
    exit;
}

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: usuario.php");
    exit;
}

$idUsuario = $_SESSION['usuario']['id'] ?? null;

if (!$idUsuario) {
    die("No se pudo identificar al usuario.");
}

$nombreProyecto = trim($_POST['nombre_proyecto'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

$fechaInicio = !empty($_POST['fecha_inicio'])
    ? $_POST['fecha_inicio']
    : null;

$fechaFinal = !empty($_POST['fecha_final'])
    ? $_POST['fecha_final']
    : null;

$estado = trim($_POST['estado'] ?? '');

$idProgramador = !empty($_POST['id_programador'])
    ? $_POST['id_programador']
    : null;

if ($nombreProyecto === '' || $estado === '') {
    die("El nombre del proyecto y el estado son obligatorios.");
}

$datos = [

    'nombre_proyecto' => $nombreProyecto,

    'descripcion' => $descripcion,

    'fecha_inicio' => $fechaInicio,

    'fecha_final' => $fechaFinal,

    'estado' => $estado,

    'id_programador' => $idProgramador,

    'id_usuario' => $idUsuario

];

$resultado = consultarSupabase(
    'Proyecto',
    'POST',
    $datos
);

header("Location: usuario.php");
exit;

?>