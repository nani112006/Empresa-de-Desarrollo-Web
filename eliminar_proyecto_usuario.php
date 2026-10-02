<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_usuario.php");
    exit;
}

require_once 'conexion.php';

$idUsuario = $_SESSION['usuario']['id'] ?? null;
$idProyecto = $_GET['id'] ?? null;

if (!$idUsuario || !$idProyecto) {
    header("Location: usuario.php");
    exit;
}

/*
 * Comprobamos que el proyecto
 * pertenezca al usuario conectado
 */

$proyecto = consultarSupabase(
    "Proyecto?id_proyecto=eq." . urlencode($idProyecto) .
    "&id_usuario=eq." . urlencode($idUsuario) .
    "&select=*"
);

if (!is_array($proyecto) || count($proyecto) === 0) {
    die("No tenés permiso para eliminar este proyecto.");
}

/*
 * DELETE directo a Supabase
 */

$project_ref = "lfxxzmufeikrboikbfuv";
$apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpc9JQ_RZ6Kkijf";

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

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

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

die("No se pudo eliminar el proyecto.");

?>