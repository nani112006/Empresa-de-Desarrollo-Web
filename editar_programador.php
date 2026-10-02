<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: admin.php");
    exit;
}

$programadores = consultarSupabase(
    "programador?id_programador=eq." .
    urlencode($id) .
    "&select=*"
);

if (!is_array($programadores) || count($programadores) === 0) {
    die("Programador no encontrado.");
}

$programador = $programadores[0];

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar programador</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h3 class="mb-0">
                Editar programador
            </h3>

        </div>

        <div class="card-body">

            <form
                action="actualizar_programador.php"
                method="POST">

                <input
                    type="hidden"
                    name="id_programador"
                    value="<?= htmlspecialchars($programador['id_programador'] ?? '') ?>">

                <div class="mb-3">

                    <label class="form-label">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        value="<?= htmlspecialchars($programador['nombre'] ?? '') ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Apellido
                    </label>

                    <input
                        type="text"
                        name="apellido"
                        class="form-control"
                        value="<?= htmlspecialchars($programador['apellido'] ?? '') ?>"
                        required>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= htmlspecialchars($programador['email'] ?? '') ?>"
                        required>

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