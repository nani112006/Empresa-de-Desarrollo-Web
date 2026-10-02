<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_usuario.php");
    exit;
}

require_once 'conexion.php';

$programadores = consultarSupabase(
    "programador?select=*"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo proyecto</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h3 class="mb-0">
                Crear nuevo proyecto
            </h3>

        </div>

        <div class="card-body">

            <form
                action="registrar_proyecto_usuario.php"
                method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nombre del proyecto
                    </label>

                    <input
                        type="text"
                        name="nombre_proyecto"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                        rows="4"></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Fecha de inicio
                        </label>

                        <input
                            type="date"
                            name="fecha_inicio"
                            class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Fecha final
                        </label>

                        <input
                            type="date"
                            name="fecha_final"
                            class="form-control">

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

                        <option value="">
                            Seleccionar estado
                        </option>

                        <option value="Pendiente">
                            Pendiente
                        </option>

                        <option value="En Proceso">
                            En Proceso
                        </option>

                        <option value="Finalizado">
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

                        <?php

                        if (is_array($programadores)):

                            foreach ($programadores as $programador):

                        ?>

                            <option
                                value="<?= htmlspecialchars($programador['id_programador'] ?? '') ?>">

                                <?= htmlspecialchars(
                                    ($programador['nombre'] ?? '') .
                                    ' ' .
                                    ($programador['apellido'] ?? '')
                                ) ?>

                            </option>

                        <?php

                            endforeach;

                        endif;

                        ?>

                    </select>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-success">

                        Crear proyecto

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