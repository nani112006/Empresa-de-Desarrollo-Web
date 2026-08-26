<?php
require_once 'conexion.php';

$programadores = consultarSupabase("Programador?select=id_programador, nombre, apellido");
$comercios = consultarSupabase("Comercio?select=id_comercio, nombre_comercio");
$empresas = consultarSupabase("Empresa?select=id_empresa, nombre_empresa");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $datos = [
        'descripcion' => $_POST['descripcion'],
        'fecha_inicio' => $_POST['fecha_inicio']? $_POST['fecha_inicio']: null      ,
        'fecha_final' => $_POST['fecha_final'],
        'estado' => $_POST['estado'],
        'id_programador' => $_POST['id_programador']? (int)$_POST['id_programador']: null,
        'id_comercio' => $_POST['id_comercio']? (int)$_POST['id_comercio']: null,
        'id_empresa' => $_POST['id_empresa']? (int)$_POST['id_empresa']: null
    ];

    consultarSupabase('Proyecto','POST', $datos);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Proyecto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="row justify-content-center">
    <div class="col-md-8">
        <h3>Crear Nuevo Proyecto</h3>
        <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label>Nombre del Proyecto</label>
            <input type="text" name="nombre_proyecto" class="form-control" required>
            </div>
            <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-mb-4">
                    <label>Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Fecha Final</label>
                    <input type="date" name="fecha_final" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>Estado</label>
                    <select name="estado" class="form-select">
                        <option value="Pendiente">Pendiente</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Completado">Completado</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Programador Asignado</label>
                <select name="id_programador" class="form-select">
                    <option value="">-- sin asignar --</option>
                    <?php if (is_array($programadores)): foreach ($programadores as $p):  ?>
                        <option value="<?= $p['id_programador'] ?>"><?= htmlspecialchars($p['nombre'].' '.$p['apellido']) ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Cliente Comericio (Opcional)</label>
                <select name="id_comercio" class="form-select">
                    <option value="">-- Ninguno --</option>
                    <?php if (is_array($comercios)): foreach ($comercios as $c):  ?>
                        <option value="<?= $c['id_comercio'] ?>">
                            <?= htmlspecialchars($c['nombre_comercio']) ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Cliente Empresa (Opcional)</label>
                <select name="id_empresa" class="form-select">
                    <option value="">-- Ninguno --</option>
                    <?php if (is_array($empresas)): foreach ($empresas as $e):  ?>
                        <option value="<?= $e['id_empresa'] ?>">
                            <?= htmlspecialchars($e['nombre_empresa']) ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar Proyecto</button>
            <a  href="index.php" class="btn btn-link text-secondary">Volver</a>
        </form>
    </div>  
    </div>
</body>
</html>