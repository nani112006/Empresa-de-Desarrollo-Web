<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: nuevo_comercio.php");
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

$resultado = consultarSupabase(
    'comercio',
    'POST',
    $datos
);

header("Location: admin.php");
exit;

?>