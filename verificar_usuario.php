<?php

session_start();

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header("Location: login_usuario.php");
    exit;

}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {

    header("Location: login_usuario.php");
    exit;

}

$usuarios = consultarSupabase(
    'usuarios?email=eq.' .
    urlencode($email) .
    '&select=*'
);

if (
    !is_array($usuarios) ||
    count($usuarios) === 0
) {

    header("Location: login_usuario.php");
    exit;

}

$usuario = $usuarios[0];

if (
    !isset($usuario['password']) ||
    !password_verify(
        $password,
        $usuario['password']
    )
) {

    header("Location: login_usuario.php");
    exit;

}

$_SESSION['usuario'] = [

    'id' => $usuario['id_usuario'] ?? null,

    'nombre' => $usuario['nombre'] ?? '',

    'apellido' => $usuario['apellido'] ?? '',

    'email' => $usuario['email'] ?? ''

];

header("Location: usuario.php");
exit;

?>