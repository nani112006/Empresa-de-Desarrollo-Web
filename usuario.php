<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_usuario.php");
    exit;
}

require_once 'conexion.php';

$proyectos = consultarSupabase(
    "Proyecto?select=*,programador(nombre,apellido)"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Área de Usuario</title>

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

            <span class="text-white me-3">

                Hola,
                <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>

            </span>

            <a
                href="cerrar_sesion_usuario.php"
                class="btn btn-danger">

                Cerrar sesión

            </a>

        </div>

    </div>

</nav>


<div class="container mt-5">

    <div class="text-center mb-5">

        <h1>
            Bienvenido,
            <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>
        </h1>

        <p class="lead">
            Estos son los proyectos disponibles.
        </p>

    </div>


    <div class="card shadow">

        <div class="card-header">

            <h3 class="mb-0">
                Proyectos
            </h3>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Proyecto</th>

                        <th>Programador</th>

                        <th>Estado</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (is_array($proyectos) && count($proyectos) > 0): ?>

                        <?php foreach ($proyectos as $p): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars(
                                        $p['id_proyecto'] ?? ''
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $p['nombre_proyecto'] ?? ''
                                    ) ?>
                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        ($p['programador']['nombre'] ?? '') .
                                        ' ' .
                                        ($p['programador']['apellido'] ?? '')
                                    ) ?>

                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $p['estado'] ?? ''
                                    ) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="4" class="text-center">

                                No hay proyectos disponibles.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>