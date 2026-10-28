<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin.php");
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');

if ($nombre === '' || $direccion === '' || $telefono === '') {
    die("Todos los campos son obligatorios.");
}

$datos = [
    'nombre' => $nombre,
    'direccion' => $direccion,
    'telefono' => $telefono
];

$resultado = consultarSupabase('comercio', 'POST', $datos);

if (!is_array($resultado) || count($resultado) === 0) {
    die(
        "No se pudo registrar el comercio. Revisá las restricciones " .
        "y permisos de la tabla comercio en Supabase."
    );
}

header("Location: admin.php");
exit;
?>