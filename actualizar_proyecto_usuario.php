<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_usuario.php");
    exit;
}

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: usuario.php");
    exit;
}

$idUsuario = $_SESSION['usuario']['id'] ?? null;
$idProyecto = $_POST['id_proyecto'] ?? null;

if (!$idUsuario || !$idProyecto) {
    header("Location: usuario.php");
    exit;
}

$nombreProyecto = trim($_POST['nombre_proyecto'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

$fechaInicio = !empty($_POST['fecha_inicio'])
    ? $_POST['fecha_inicio']
    : null;

$fechaFinal = !empty($_POST['fecha_final'])
    ? $_POST['fecha_final']
    : null;

$estado = trim($_POST['estado'] ?? '');

$idProgramador = !empty($_POST['id_programador'])
    ? $_POST['id_programador']
    : null;

if ($nombreProyecto === '' || $estado === '') {
    die("El nombre del proyecto y el estado son obligatorios.");
}

/*
 * Primero comprobamos que el proyecto
 * pertenezca al usuario conectado
 */

$proyecto = consultarSupabase(
    "Proyecto?id_proyecto=eq." . urlencode($idProyecto) .
    "&id_usuario=eq." . urlencode($idUsuario) .
    "&select=*"
);

if (!is_array($proyecto) || count($proyecto) === 0) {
    die("No tenés permiso para modificar este proyecto.");
}

/*
 * La conexión actual solamente permite
 * GET y POST, por lo que no usamos PATCH acá.
 */

$datos = [

    'nombre_proyecto' => $nombreProyecto,

    'descripcion' => $descripcion,

    'fecha_inicio' => $fechaInicio,

    'fecha_final' => $fechaFinal,

    'estado' => $estado,

    'id_programador' => $idProgramador

];

/*
 * Para actualizar en Supabase se necesita PATCH.
 * Tu conexion.php actual no lo soporta.
 */

$project_ref = "lfxxzmufeikrboikbfuv";
$apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpcJ9UQ_RZ6Kkijf";

$url = "https://{$project_ref}.supabase.co/rest/v1/Proyecto"
     . "?id_proyecto=eq." . urlencode($idProyecto)
     . "&id_usuario=eq." . urlencode($idUsuario);

$ch = curl_init();

$headers = [

    "apikey: {$apiKey}",

    "Authorization: Bearer {$apiKey}",

    "Content-Type: application/json",

    "Prefer: return=representation"

];

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

curl_setopt(
    $ch,
    CURLOPT_POSTFIELDS,
    json_encode($datos)
);

$response = curl_exec($ch);

$httpCode = curl_getinfo(
    $ch,
    CURLINFO_HTTP_CODE
);

curl_close($ch);

if ($httpCode >= 200 && $httpCode < 300) {

    header("Location: usuario.php");
    exit;

}

die("No se pudo actualizar el proyecto.");

?>