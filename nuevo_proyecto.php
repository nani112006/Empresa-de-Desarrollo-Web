<?php
require_once 'conexion.php';

$programadores = consultarSupabase("Programador?select=id_programador, nombre, apellido");
$comercios = consultarSupabase("Comercio?select=id_comercio, nombre_comercio");
$empresas = consultarSupabase("Empresa?select=id_empresa, nombre_empresa");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $datos = [
        'descripcion' => $_POST['descripcion'],
        'fecha_inicio' => $_POST['fecha_inicio']? ,
        'fecha_final' => $_POST['fecha_final'],
        'estado' => $_POST['estado'],
    ];

    consultarSupabase('Proyecto','POST', $datos);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Proyecto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="row justify-content-center">