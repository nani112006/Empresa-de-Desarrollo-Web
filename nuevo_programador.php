<?php
require_once 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $datos = [
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'especialidad' => $_POST['especialidad'],
        'email' => $_POST['email']
    ];

    consultarSupabase('Programadores','POST', $datos);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Programador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="row justify-content-center">
    <div class="col-md-6">
        <h3>Registrar Programador</h3>
        <from method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Apellido</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Especialidad</label>
                <input type="text" name="especialidad" class="form-control" placeholder="Ej. PHP Backend">
            </div>
            <div class="mb-3">
                <label>Correo Electrónico</label>
                </label>
                <input type="email" name="email" class="form-control" required>
                </div>
              <button type="submit" class="btn btn-primary">Guardar Programador</button>
        </from>
    </div>
</div>
</body>
</html>