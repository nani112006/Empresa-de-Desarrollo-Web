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

$id = $_POST['id_comercio'] ?? null;

$nombre = trim($_POST['nombre'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');

if (!$id) {
    header("Location: admin.php");
    exit;
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
$apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpc9JQ_RZ6Kkijf";

$url = "https://{$project_ref}.supabase.co/rest/v1/comercio"
     . "?id_comercio=eq." . urlencode($id);

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

    header("Location: admin.php");
    exit;

}

die("No se pudo actualizar el comercio.");

?>