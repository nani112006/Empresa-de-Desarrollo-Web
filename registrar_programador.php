<?php
require_once 'conexion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono']
    ];

    consultarSupabase('Programador', 'POST', $datos);
    header('Location: index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Programador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


</head>
<body class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">Registrar Nuevo Programador</h3>

            <form method="POST" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <Label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <Label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Telefono</label>
                    <input type="text" name="telefono" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Programador</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    </body>
    </html>
