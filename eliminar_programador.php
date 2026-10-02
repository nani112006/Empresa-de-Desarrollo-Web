<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: admin.php");
    exit;
}

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

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

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

die("No se pudo eliminar el programador.");

?>