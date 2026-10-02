<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

$proyectos = consultarSupabase(
    "Proyecto?select=*,programador(nombre,apellido)"
);

$programadores = consultarSupabase(
    "programador?select=*"
);

$comercios = consultarSupabase(
    "comercio?select=*"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Panel administrador</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <span class="navbar-brand">
            Panel administrador
        </span>

        <a
            href="cerrar_sesion.php"
            class="btn btn-danger">

            Cerrar sesión

        </a>

    </div>

</nav>


<div class="container mt-5">


    <!-- PROYECTOS -->

    <div class="card shadow mb-5">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Proyectos
            </h3>

            <a
                href="nuevo_proyecto.php"
                class="btn btn-success">

                + Nuevo proyecto

            </a>

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

                        <th>Acciones</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (
                        is_array($proyectos) &&
                        count($proyectos) > 0
                    ): ?>

                        <?php foreach ($proyectos as $proyecto): ?>

                            <tr>

                                <td>

                                    <?= htmlspecialchars(
                                        $proyecto['id_proyecto'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $proyecto['nombre_proyecto'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(

                                        ($proyecto['programador']['nombre'] ?? '') .
                                        ' ' .
                                        ($proyecto['programador']['apellido'] ?? '')

                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $proyecto['estado'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <a
                                        href="editar_proyecto.php?id=<?= urlencode($proyecto['id_proyecto'] ?? '') ?>"
                                        class="btn btn-warning btn-sm">

                                        Editar

                                    </a>

                                    <a
                                        href="eliminar_proyecto.php?id=<?= urlencode($proyecto['id_proyecto'] ?? '') ?>"
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
                                colspan="5"
                                class="text-center">

                                No hay proyectos.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- PROGRAMADORES -->

    <div class="card shadow mb-5">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Programadores
            </h3>

            <a
                href="nuevo_programador.php"
                class="btn btn-success">

                + Nuevo programador

            </a>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nombre</th>

                        <th>Apellido</th>

                        <th>Email</th>

                        <th>Acciones</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (
                        is_array($programadores) &&
                        count($programadores) > 0
                    ): ?>

                        <?php foreach ($programadores as $programador): ?>

                            <tr>

                                <td>

                                    <?= htmlspecialchars(
                                        $programador['id_programador'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $programador['nombre'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $programador['apellido'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $programador['email'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <a
                                        href="editar_programador.php?id=<?= urlencode($programador['id_programador'] ?? '') ?>"
                                        class="btn btn-warning btn-sm">

                                        Editar

                                    </a>

                                    <a
                                        href="eliminar_programador.php?id=<?= urlencode($programador['id_programador'] ?? '') ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que querés eliminar este programador?');">

                                        Eliminar

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="5"
                                class="text-center">

                                No hay programadores.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- COMERCIO -->

    <div class="card shadow mb-5">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Comercio
            </h3>

            <a
                href="nuevo_comercio.php"
                class="btn btn-success">

                + Nuevo comercio

            </a>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nombre</th>

                        <th>Dirección</th>

                        <th>Teléfono</th>

                        <th>Acciones</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (
                        is_array($comercios) &&
                        count($comercios) > 0
                    ): ?>

                        <?php foreach ($comercios as $comercio): ?>

                            <tr>

                                <td>

                                    <?= htmlspecialchars(
                                        $comercio['id_comercio'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $comercio['nombre'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $comercio['direccion'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $comercio['telefono'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <a
                                        href="editar_comercio.php?id=<?= urlencode($comercio['id_comercio'] ?? '') ?>"
                                        class="btn btn-warning btn-sm">

                                        Editar

                                    </a>

                                    <a
                                        href="eliminar_comercio.php?id=<?= urlencode($comercio['id_comercio'] ?? '') ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que querés eliminar este comercio?');">

                                        Eliminar

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="5"
                                class="text-center">

                                No hay comercios.

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