<?php

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: registro.php");
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($nombre === '' || $apellido === '' || $email === '' || $password === '') {
    die("Todos los campos son obligatorios.");
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$datos = [
    'nombre' => $nombre,
    'apellido' => $apellido,
    'email' => $email,
    'password' => $passwordHash
];

$resultado = consultarSupabase(
    'usuarios',
    'POST',
    $datos
);

header("Location: login_usuario.php");
exit;
?>