<?php
session_start();

if (!isset($_SESSION['admin.php'])){
    header('Location: login.php');
    exit;
}

require_once 'conexion.php';

$proyectos = consultarSupabase(
    "Proyecto?select=*,programador(nombre,apellido)"

);
$programadores = consultarSupabase(
    "Programador?select=*"

);
$comercios = consultarSupabase(
    "Comercio?select=*"

);
$empresas = consultarSupabase(
    "Empresa?select=*"

);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Panel de Administracion</h1>

            <a href="cerrar_sesion.php"
            class="btn btn-danger">Cerrar Sesion</a>
</div>
            <!-- PROYECTOS-->            

            <div class="card mb-4">
                <div class="card-headerd-flex justify-content-between">
            
            <h3>Proyectos</h2>

            <a href="nuevo_proyecto.php" class="btn btn-success">
                Nuevo Proyecto
</a>
</div>
            <div class="card-body">
                <div class="table table-responsive">
                <table class="table table-striped">
                    <thead>
            <tr>
            <th>ID</th>
            <th>Proyecto</th>
            <th>Programador</th>
            <th>Estado</th>
            <th>Acciones</th>
            </tr>
            </thead>
            
            <tbody>
    <?php foreach($proyectos as $p): ?>
        <tr>
            <td>
    <? = htmlspecialchars($p['id_proyecto']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($p['nombre_proyecto']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($p['progremador']['nombre']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($p['programador']['apellido']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($p['estado']?? '')?>
    </td>

    <td>
    <a href="editar_proyecto.php?id=<?=$p['id_proyecto'] ?>"
    class="btn btn-warning btn-sm">
        Editar
    </a>
    
    <a href="eliminar_proyecto-php?id=<?=$p['id_proyecto']?>"
        class="btn btn-danger btn-sm"
        onclick="return confitm('¿Seguro que queres eliminar este proyecto?')">
        Eliminar
    </a>

    </td>
    <tr>
    
<?php endforeach; ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>

    <!-- Programadores -->

        <div class="card mb-4">
                <div class="card-headerd-flex justify-content-between">
            
            <h3>Programadores</h3>

            <a href="nuevo_programador.php" class="btn btn-success">
                Nuevo Programador
</a>
</div>
            <div class="card-body">
                <div class="table table-responsive">
                <table class="table table-striped">
                    <thead>
            <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Especialidad</th>
            <th>Email</th>
            <th>Acciones</th>
            </tr>
            </thead>
            
            <tbody>
    <?php foreach($programadores as $pr): ?>
        <tr>
            <td>
    <? = htmlspecialchars($pr['id_progrmador']?? $pr['id_programador']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($pr['nombre']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($pr['apellido']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($pr['especialidad']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($pr['email']?? '')?>
    </td>

    <td>
        <?php
        <$idProgramador = $pr['id_programador'] ?? $pr['id_programador'] ?? '';
        ?>
    <a href="editar_programador.php?id=<?= $idProgramador ?>"
    class="btn btn-warning btn-sm">
        Editar
    </a>
    
    <a href="eliminar_programador-php?id=<?= $idProgramador ?>"
        class="btn btn-danger btn-sm"
        onclick="return confitm('¿Seguro que queres eliminar este programador?')">
        Eliminar
    </a>

    </td>
    <tr>
    
<?php endforeach; ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
     
          <!-- COMERCIOS -->
        <div class="card mb-4">
                <div class="card-headerd-flex justify-content-between">
            
            <h3>Comercios</h3>

            <a href="nuevo_comercio.php" class="btn btn-success">
                Nuevo Comercio
</a>
</div>
            <div class="card-body">
                <div class="table table-responsive">
                <table class="table table-striped">
                    <thead>
            <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Acciones</th>
            </tr>
            </thead>
            
            <tbody>
    <?php foreach($comercios as $c): ?>
        <tr>
            <td>
    <? = htmlspecialchars($c['id_proyecto']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($c['nombre_comercio']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($c['telefono']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($c['email']?? '')?>
    </td>

    <td>
    <a href="editar_comercio.php?id=<?=$p['id_comercio'] ?>"
    class="btn btn-warning btn-sm">
        Editar
    </a>
    
    <a href="eliminar_comercio.php?id=<?=$p['id_comercio']?>"
        class="btn btn-danger btn-sm"
        onclick="return confitm('¿Seguro que queres eliminar este comercio?')">
        Eliminar
    </a>

    </td>
    <tr>
    
<?php endforeach; ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>

         <!-- EMPRESAS -->
        <div class="card mb-4">
                <div class="card-headerd-flex justify-content-between">
            
            <h3>Empresas</h3>

            <a href="nueva_empresa.php" class="btn btn-success">
                Nueva Empresa
</a>
</div>
            <div class="card-body">
                <div class="table table-responsive">
                <table class="table table-striped">
                    <thead>
            <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Acciones</th>
            </tr>
            </thead>
            
            <tbody>
    <?php foreach($empresas as $e): ?>
        <tr>
            <td>
    <? = htmlspecialchars($c['id_empresa']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($e['nombre_empresa']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($e['telefono']?? '')?>
    </td>

    <td>
    <? = htmlspecialchars($e['email']?? '')?>
    </td>

    <td>
    <a href="editar_empresa.php?id=<?=$p['id_empresa'] ?>"
    class="btn btn-warning btn-sm">
        Editar
    </a>
    
    <a href="eliminar_empresa.php?id=<?=$p['id_empresa']?>"
        class="btn btn-danger btn-sm"
        onclick="return confitm('¿Seguro que queres eliminar esta Emprasa?')">
        Eliminar
    </a>

    </td>
    <tr>
    
<?php endforeach; ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>






















