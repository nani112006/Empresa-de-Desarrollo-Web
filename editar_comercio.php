
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

$id = $_GET['id'] ?? '';

if ($id === '' || !ctype_digit((string)$id)) {
    die("El ID del comercio no es válido.");
}

$comercios = consultarSupabase(
    "comercio?id_comercio=eq." . urlencode((string)$id) . "&select=*"
);

if (!is_array($comercios) || count($comercios) === 0) {
    die("No se encontró el comercio.");
}

$comercio = $comercios[0];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar comercio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">Editar comercio</h3>
        </div>

        <div class="card-body">

            <form action="actualizar_comercio.php" method="POST">

                <input
                    type="hidden"
                    name="id_comercio"
                    value="<?= htmlspecialchars((string)$comercio['id_comercio']) ?>"
                >

                <div class="mb-3">
                    <label class="form-label">Nombre del comercio</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nombre_comercio"
                        value="<?= htmlspecialchars($comercio['nombre_comercio'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input
                        type="text"
                        class="form-control"
                        name="direccion"
                        value="<?= htmlspecialchars($comercio['direccion'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">Teléfono</label>
                    <input
                        type="text"
                        class="form-control"
                        name="telefono"
                        value="<?= htmlspecialchars($comercio['telefono'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Guardar cambios
                    </button>

                    <a href="admin.php" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>