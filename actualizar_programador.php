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

$id = $_POST['id_programador'] ?? null;

$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$email = trim($_POST['email'] ?? '');

if (!$id) {
    header("Location: admin.php");
    exit;
}

if ($nombre === '' || $apellido === '' || $email === '') {
    die("Todos los campos son obligatorios.");
}

$datos = [

    'nombre' => $nombre,

    'apellido' => $apellido,

    'email' => $email

];

$project_ref = "lfxxzmufeikrboikbfuv";
$apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpc9JQ_RZ6Kkijf";

$url = "https://{$project_ref}.supabase.co/rest/v1/programador"
     . "?id_programador=eq." . urlencode($id);

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

die("No se pudo actualizar el programador.");

?>