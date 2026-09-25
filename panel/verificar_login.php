<?php

session_start();

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

if ($usuario === 'admin' && $password === '1234') {

    $_SESSION['admin'] = true;

    header("Location: admin.php");
    exit;

} else {

    echo "
    <script>
        alert('Usuario o contraseña incorrectos');
        window.location.href = 'login.php';
    </script>
    ";

    exit;
}
?>