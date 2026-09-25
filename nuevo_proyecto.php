<?php
require_once 'conexion.php';

// Cargar la lista de programadores para el desplegable (select)
$programadores = consultarSupabase("programador?select=id_Programador,nombre,apellido");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre_proyecto' => $_POST['nombre_proyecto'],
        'descripcion'     => $_POST['descripcion'],
        'fecha_inicio'    => !empty($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null,
        'fecha_final'     => !empty($_POST['fecha_final']) ? $_POST['fecha_final'] : null,
        'estado'          => $_POST['estado'],
        'id_programador'  => !empty($_POST['id_programador']) ? $_POST['id_programador'] : null
    ];

    consultarSupabase('Proyecto', 'POST', $datos);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Proyecto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">Registrar Nuevo Proyecto</h3>
            
            <form method="POST" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label class="form-label">Nombre del Proyecto</label>
                    <input type="text" name="nombre_proyecto" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha Final</label>
                        <input type="date" name="fecha_final" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="En Proceso">En Proceso</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Finalizado">Finalizado</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Programador Asignado</label>
                    <select name="id_programador" class="form-select">
                        <option value="">-- Seleccionar Programador --</option>
                        <?php if (is_array($programadores)): foreach ($programadores as $pr): ?>
                            <option value="<?= $pr['id_Programador'] ?? $pr['id_programador'] ?>">
                                <?= htmlspecialchars($pr['nombre'] . ' ' . $pr['apellido']) ?>
                            </option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>