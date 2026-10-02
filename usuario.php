<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_usuario.php");
    exit;
}

require_once 'conexion.php';

$idUsuario = $_SESSION['usuario']['id'] ?? null;

$proyectos = [];

if ($idUsuario) {

    $proyectos = consultarSupabase(
        "Proyecto?id_usuario=eq." . urlencode($idUsuario) .
        "&select=*,programador(nombre,apellido)"
    );

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

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
                <?= htmlspecialchars(
                    $_SESSION['usuario']['nombre'] ?? ''
                ) ?>

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

    <div class="text-center mb-4">

        <h1>

            Bienvenido,
            <?= htmlspecialchars(
                $_SESSION['usuario']['nombre'] ?? ''
            ) ?>

        </h1>

        <p class="lead">
            Estos son tus proyectos.
        </p>

    </div>


    <div class="d-flex justify-content-end mb-3">

        <a
            href="nuevo_proyecto_usuario.php"
            class="btn btn-success">

            + Crear proyecto

        </a>

    </div>


    <div class="card shadow">

        <div class="card-header">

            <h3 class="mb-0">
                Mis proyectos
            </h3>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Proyecto</th>

                        <th>Descripción</th>

                        <th>Programador</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                    </thead>


                    <tbody>

                    <?php if (
                        is_array($proyectos) &&
                        count($proyectos) > 0
                    ): ?>

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
                                        $p['descripcion'] ?? ''
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


                                <td>

                                    <a
                                        href="editar_proyecto_usuario.php?id=<?= urlencode($p['id_proyecto'] ?? '') ?>"
                                        class="btn btn-warning btn-sm">

                                        Editar

                                    </a>


                                    <a
                                        href="eliminar_proyecto_usuario.php?id=<?= urlencode($p['id_proyecto'] ?? '') ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que querés eliminar este proyecto?');">

                                        Eliminar

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="6"
                                class="text-center">

                                Todavía no tenés proyectos.

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