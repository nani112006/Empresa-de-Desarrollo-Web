
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin.php");
    exit;
}

$nombreProyecto = trim($_POST['nombre_proyecto'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');
$fechaInicio = !empty($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;
$fechaFinal = !empty($_POST['fecha_final']) ? $_POST['fecha_final'] : null;
$estado = trim($_POST['estado'] ?? '');
$idProgramador = $_POST['id_programador'] ?? '';

if (
    $nombreProyecto === '' ||
    $estado === '' ||
    $idProgramador === '' ||
    !ctype_digit((string)$idProgramador)
) {
    die("Completá el nombre, el estado y seleccioná un programador válido.");
}

$datos = [
    'nombre_proyecto' => $nombreProyecto,
    'descripcion' => $descripcion,
    'fecha_inicio' => $fechaInicio,
    'fecha_final' => $fechaFinal,
    'estado' => $estado,
    'id_programador' => (int)$idProgramador
];

$resultado = consultarSupabase('Proyecto', 'POST', $datos);

if (!is_array($resultado) || count($resultado) === 0) {
    die(
        "No se pudo registrar el proyecto. Supabase no confirmó la creación. " .
        "Revisá las restricciones y permisos de la tabla Proyecto."
    );
}

header("Location: admin.php");
exit;
?>
