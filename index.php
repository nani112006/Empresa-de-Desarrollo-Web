<?php
require_once 'conexion.php';

// Consulta para traer los proyectos junto a la información de su programador asignado
$endpoint = "Proyecto?select=*,programador(nombre,apellido)";
$proyectos = consultarSupabase($endpoint);

$programadores = consultarSupabase("programador?select=*");
$comercios     = consultarSupabase("comercio?select=*");
$empresas      = consultarSupabase("Empresa?select=*");
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Empresa de Desarrollo Web</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <span class="navbar-brand">
            Empresa de Desarrollo Web
        </span>

        <div>

            <a
                href="login_usuario.php"
                class="btn btn-outline-light me-2">

                Iniciar sesión

            </a>

            <a
                href="registro.php"
                class="btn btn-primary me-2">

                Registrarse

            </a>

            <a
                href="login.php"
                class="btn btn-warning">

                Administrador

            </a>

        </div>

    </div>

</nav>

<div class="container text-center mt-5">

    <h1 class="display-4">
        Bienvenido
    </h1>

    <p class="lead mt-3">
        Empresa dedicada al desarrollo de proyectos y soluciones web.
    </p>

    <p class="text-muted">
        Registrate para acceder a nuestros proyectos y consultar
        la información disponible.
    </p>

    <div class="mt-4">

        <a
            href="registro.php"
            class="btn btn-primary btn-lg me-2">

            Crear una cuenta

        </a>

        <a
            href="login_usuario.php"
            class="btn btn-dark btn-lg">

            Iniciar sesión

        </a>

    </div>

    <div class="mt-5">

        <p>
            ¿Sos administrador?
        </p>

        <a
            href="login.php"
            class="btn btn-warning">

            Acceso administrador

        </a>

    </div>

</div>

</body>
</html>