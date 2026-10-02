<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_usuario.php");
    exit;
}

require_once 'conexion.php';

$idUsuario = $_SESSION['usuario']['id'] ?? null;
$idProyecto = $_GET['id'] ?? null;

if (!$idUsuario || !$idProyecto) {
    header("Location: usuario.php");
    exit;
}

$proyectos = consultarSupabase(
    "Proyecto?id_proyecto=eq." . urlencode($idProyecto) .
    "&id_usuario=eq." . urlencode($idUsuario) .
    "&select=*"
);

if (!is_array($proyectos) || count($proyectos) === 0) {
    die("Proyecto no encontrado.");
}

$proyecto = $proyectos[0];

$programadores = consultarSupabase(
    "programador?select=*"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Editar proyecto</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h3 class="mb-0">
                Editar proyecto
            </h3>

        </div>

        <div class="card-body">

            <form
                action="actualizar_proyecto_usuario.php"
                method="POST">

                <input
                    type="hidden"
                    name="id_proyecto"
                    value="<?= htmlspecialchars($proyecto['id_proyecto'] ?? '') ?>">

                <div class="mb-3">

                    <label class="form-label">
                        Nombre del proyecto
                    </label>

                    <input
                        type="text"
                        name="nombre_proyecto"
                        class="form-control"
                        value="<?= htmlspecialchars($proyecto['nombre_proyecto'] ?? '') ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                        rows="4"><?= htmlspecialchars($proyecto['descripcion'] ?? '') ?></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Fecha de inicio
                        </label>

                        <input
                            type="date"
                            name="fecha_inicio"
                            class="form-control"
                            value="<?= htmlspecialchars($proyecto['fecha_inicio'] ?? '') ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Fecha final
                        </label>

                        <input
                            type="date"
                            name="fecha_final"
                            class="form-control"
                            value="<?= htmlspecialchars($proyecto['fecha_final'] ?? '') ?>">

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="form-select"
                        required>

                        <option
                            value="Pendiente"
                            <?= ($proyecto['estado'] ?? '') === 'Pendiente' ? 'selected' : '' ?>>

                            Pendiente

                        </option>

                        <option
                            value="En Proceso"
                            <?= ($proyecto['estado'] ?? '') === 'En Proceso' ? 'selected' : '' ?>>

                            En Proceso

                        </option>

                        <option
                            value="Finalizado"
                            <?= ($proyecto['estado'] ?? '') === 'Finalizado' ? 'selected' : '' ?>>

                            Finalizado

                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Programador
                    </label>

                    <select
                        name="id_programador"
                        class="form-select">

                        <option value="">
                            Sin programador
                        </option>

                        <?php if (is_array($programadores)): ?>

                            <?php foreach ($programadores as $programador): ?>

                                <option
                                    value="<?= htmlspecialchars($programador['id_programador'] ?? '') ?>"
                                    <?= ($proyecto['id_programador'] ?? '') == ($programador['id_programador'] ?? '') ? 'selected' : '' ?>>

                                    <?= htmlspecialchars(
                                        ($programador['nombre'] ?? '') .
                                        ' ' .
                                        ($programador['apellido'] ?? '')
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </select>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Guardar cambios

                    </button>

                    <button
                        type="button"
                        class="btn btn-secondary"
                        onclick="history.back()">

                        Cancelar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>