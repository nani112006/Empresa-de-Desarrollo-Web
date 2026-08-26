<?php
require_once 'conexion.php';
$endpoint = "Proyecto?select=*(nombre,apellido),Comercio(nombre_comercio),Empresa(nombre_empresa)";
$proyectos=consultarSupabase($endpoint);

$programadores = consultarSupabase("Programador?select=*");
$comercios = consultarSupabase("Comercio?select=*");
$empresas = consultarSupabase("Empresa?select=*");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body  class="bg-light container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Panel de Gestion</h2>
        <div>
            <a href="nuevo_proyecto.php" class="btn btn-secondary">Proyectos</a>
            <a href="nuevo_programador.php" class="btn btn-secondary">Programadores</a>
            <a href="nuevo_comercio.php" class="btn btn-secondary">Comercios</a>
            <a href="nuevo_empresa.php" class="btn btn-secondary">Empresas</a>
        </div>
    </div>
    <¡----petañas-------!>
        <ul class="nav nav-tabs " id="myTab" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#proyectos">Proyectos</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#programadores">Programadores</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#comercios">Comercios</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#empresas">Empresas</button></li>
        </ul>
    </div>
    <div class="tab-content bg-white border border-top-0 p-3 rounded-bottom shadow-sm">
    <¡------Tabla Proyectos-------!>
<div class="tab-pane fade show active" id="proyectos">
       <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Proyecto</th>
                    <th>Programador</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
               <?php if (is_array($proyectos)): foreach ($proyectos as $p): ?>
                    <tr>
                        <td><?= $p['id_proyecto'] ?></td>
                        <td><strong><?= htmlspecialchars($p['nombre_proyecto']) ?></strong></td>
                        <td><?= isset($p['Programador']) ? htmlspecialchars($p['Programador']['nombre']). ' '.$p['Programador']['apellido'] : 'No asignado' ?></td>
                        <td><?php if (isset($p['Comercio'])) echo 'Comercio: ' . htmlspecialchars($p['Comercio']['nombre_comercio']); 
                        elseif (isset($p['Empresa'])) echo 'Empresa: ' . htmlspecialchars($p['Empresa']['nombre_empresa']); else echo 'No asignado'; ?></td>
                        <td><span class="badge bg-info text-dark"><?= $p['estado'] ?</span></td>
                    </tr>

                <?php endforeach; endif: ?>
                   </tbody>
        </table>
    </div>
    <¡---Tabla Programadores-------!>
    <div class="tab-pane fade" id="programadores">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($programadores)): foreach ($programadores as $pr): ?>
                    <tr>
                        <td><?= $pr['id_programador'] ?></td>
                        <td><?= htmlspecialchars($pr['nombre']) ?></td>
                        <td><?= htmlspecialchars($pr['apellido']) ?></td>
                        <td><?= htmlspecialchars($pr['email']) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <¡---Tabla Comercios-------!>
    <div class="tab-pane fade" id="comercios">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Comercio</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($comercios)): foreach ($comercios as $c): ?>
                    <tr>
                        <td><?= $c['id_comercio'] ?></td>
                        <td><?= htmlspecialchars($c['nombre_comercio']) ?></td>
                        <td><?= htmlspecialchars($c['telefono']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <¡---Tabla Empresas-------!>
    <div class="tab-pane fade" id="empresas">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Empresa</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($empresas)): foreach ($empresas as $e): ?>
                    <tr>
                        <td><?= $e['id_empresa'] ?></td>
                        <td><?= htmlspecialchars($e['nombre_empresa']) ?></td>
                        <td><?= htmlspecialchars($e['telefono']) ?></td>
                        <td><?= htmlspecialchars($e['email']) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    </div>
    </body>
</html>

