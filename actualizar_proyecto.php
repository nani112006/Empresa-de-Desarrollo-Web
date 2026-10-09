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

$id = $_POST['id_proyecto'] ?? null;

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

if (!$id) {
    header("Location: admin.php");
    exit;
}

if ($nombreProyecto === '' || $estado === '') {
    die("El nombre del proyecto y el estado son obligatorios.");
}

$datos = [
    'nombre_proyecto' => $nombreProyecto,
    'descripcion' => $descripcion,
    'fecha_inicio' => $fechaInicio,
    'fecha_final' => $fechaFinal,
    'estado' => $estado,
    'id_programador' => $idProgramador
];

$project_ref = "lfxxzmufeikrboikbfuv";
$apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpcJ9UQ_RZ6Kkijf";


$url = "https://{$project_ref}.supabase.co/rest/v1/Proyecto"
     . "?id_proyecto=eq." . urlencode((string)$id);

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
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$errorCurl = curl_error($ch);

curl_close($ch);

if ($response !== false && $httpCode >= 200 && $httpCode < 300) {
    header("Location: admin.php");
    exit;
}

echo "<h3>No se pudo actualizar el proyecto.</h3>";
echo "<p>Código HTTP: " . (int)$httpCode . "</p>";
echo "<pre>";
echo htmlspecialchars(
    $errorCurl ?: ($response ?: "Error de conexión con Supabase.")
);
echo "</pre>";
echo "<a href='admin.php'>Volver al administrador</a>";
exit;