<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo comercio</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h3 class="mb-0">
                Nuevo comercio
            </h3>

        </div>

        <div class="card-body">

            <form
                action="registrar_comercio.php"
                method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Dirección
                    </label>

                    <input
                        type="text"
                        name="direccion"
                        class="form-control"
                        required>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        class="form-control"
                        required>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-success">

                        Guardar

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