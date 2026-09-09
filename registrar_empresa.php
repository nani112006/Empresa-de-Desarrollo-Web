<?php
require_once 'conexion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre' => $_POST['nombre'],
        'direccion' => $_POST['direccion'],
        'telefono' => $_POST['telefono']
    ];

    consultarSupabase('Empresa', 'POST', $datos);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empresa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">Registrar Nueva Empresa</h3>

            <form method="POST" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label class="form-label">Nombre de la Empresa</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefono</label>
                    <input type="text" name="direccion" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="telefono" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Empresa</button>

            <?php if (is_array($empresas)): foreach ($empresas as $e):?>
                <option value="<?= $e['id_Empresa'] ?? $e['id_empresa'] ?>">
                    <?= htmlspecialchars($e['nombre']) ?>
                </option>
            <?php endforeach; endif; ?>
    
                   
            
                </div>
            </form>
        </div>
    </div>
</body>
</html>