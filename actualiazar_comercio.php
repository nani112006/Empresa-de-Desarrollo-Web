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

$id = $_POST['id_comercio'] ?? '';

$nombre = trim($_POST['nombre'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');

if ($id === '' || !ctype_digit((string)$id)) {
    die("El ID del comercio no es válido.");
}

if ($nombre === '' || $direccion === '' || $telefono === '') {
    die("Todos los campos son obligatorios.");
}

$datos = [
    'nombre' => $nombre,
    'direccion' => $direccion,
    'telefono' => $telefono
];

$project_ref = "lfxxzmufeikrboikbfuv";
$apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpcJ9UQ_RZ6Kkijf";

$url = "https://{$project_ref}.supabase.co/rest/v1/comercio"
     . "?id_comercio=eq." . urlencode((string)$id);

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

if ($response === false) {
    die("Error de conexión: " . htmlspecialchars($errorCurl));
}

if ($httpCode >= 200 && $httpCode < 300) {
    header("Location: admin.php");
    exit;
}

echo "<h3>No se pudo actualizar el comercio.</h3>";
echo "<p>Código HTTP: " . (int)$httpCode . "</p>";
echo "<pre>";
echo htmlspecialchars($response ?: "Supabase no devolvió detalles del error.");
echo "</pre>";
echo "<a href='admin.php'>Volver al administrador</a>";

?>