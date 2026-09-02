<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre_comercio' => $_POST['nombre_comercio'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email'],
    ];
    consultarSupabase('Comercio', 'POST', $datos);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Comercio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">Registrar nuevo Comercio</h3>

            <form method="POST" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label class="form-label">Nombre del Comercio</label>
                    <input type="text" name="nombre_comercio" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Comercio</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>