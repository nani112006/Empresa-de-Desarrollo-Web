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

$proyectosEncontrados = consultarSupabase(
    'Proyecto?id_proyecto=eq.' . urlencode($idProyecto) .
    '&id_usuario=eq.' . urlencode($idUsuario) .
    '&select=*'
);

if (
    !is_array($proyectosEncontrados) ||
    !isset($proyectosEncontrados[0])
) {
    die("No se encontró el proyecto o hubo un error al consultar Supabase.");
}

$proyecto = $proyectosEncontrados[0];
$programadores = consultarSupabase('programador?select=*');


if (!is_array($programadores)) {
    die("No se pudieron cargar los programadores desde Supabase.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar proyecto</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>
<div class="container mt-5">

    <h2>Editar proyecto</h2>

    <form action="actualizar_proyecto_usuario.php" method="POST">

        <input
            type="hidden"
            name="id_proyecto"
            value="<?= htmlspecialchars((string)($proyecto['id_proyecto'] ?? '')) ?>"
        >

        <div class="mb-3">
            <label class="form-label">Nombre del proyecto</label>
            <input
                type="text"
                name="nombre_proyecto"
                class="form-control"
                value="<?= htmlspecialchars($proyecto['nombre_proyecto'] ?? '') ?>"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea
                name="descripcion"
                class="form-control"
            ><?= htmlspecialchars($proyecto['descripcion'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de inicio</label>
            <input
                type="date"
                name="fecha_inicio"
                class="form-control"
                value="<?= htmlspecialchars($proyecto['fecha_inicio'] ?? '') ?>"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha final</label>
            <input
                type="date"
                name="fecha_final"
                class="form-control"
                value="<?= htmlspecialchars($proyecto['fecha_final'] ?? '') ?>"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                <?php
                $estados = ['Pendiente', 'En proceso', 'Finalizado'];
                foreach ($estados as $estado):
                ?>
                    <option
                        value="<?= htmlspecialchars($estado) ?>"
                        <?= ($proyecto['estado'] ?? '') === $estado ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($estado) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Programador</label>

            <select name="id_programador" class="form-select" required>
                <option value="">Seleccioná un programador</option>

                <?php foreach ($programadores as $programador): ?>
                    <?php
                    $idLista = $programador['id_Programador'] ?? null;
                    $idActual = $proyecto['id_programador'] ?? null;
                    ?>

                    <?php if ($idLista !== null): ?>
                        <option
                            value="<?= htmlspecialchars((string)$idLista) ?>"
                            <?= (string)$idActual === (string)$idLista ? 'selected' : '' ?>
                        >
                            <?= htmlspecialchars(
                                ($programador['nombre'] ?? '') . ' ' .
                                ($programador['apellido'] ?? '')
                            ) ?>
                        </option>
                    <?php endif; ?>

                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Guardar cambios
        </button>

        <button
            type="button"
            class="btn btn-secondary"
            onclick="history.back()"
        >
            Cancelar
        </button>

    </form>
</div>
</body>
</html>
