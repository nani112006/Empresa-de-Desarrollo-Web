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
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Proyectos</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Comercio</th>
                    <th>Empresa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $proyecto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($proyecto['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($proyecto['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($proyecto['Comercio']['nombre_comercio']); ?></td>
                        <td><?php echo htmlspecialchars($proyecto['Empresa']['nombre_empresa']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botón para abrir el modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
            Agregar Proyecto
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProjectModalLabel">Agregar Proyecto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addProjectForm">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="comercio_id" class="form-label">Comerc