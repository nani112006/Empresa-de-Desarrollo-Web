
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

$id = $_GET['id'] ?? '';

if ($id === '' || !ctype_digit((string)$id)) {
    die("El ID del programador no es válido.");
}

// Comprobar si el programador tiene proyectos asociados.
$proyectos = consultarSupabase(
    "Proyecto?id_programador=eq." .
    urlencode((string)$id) .
    "&select=id_proyecto"
);

if (!is_array($proyectos)) {
    die("No se pudieron comprobar los proyectos asociados.");
}

if (count($proyectos) > 0) {
    die(
        "No se puede eliminar este programador porque tiene proyectos asociados. " .
        "Primero asigná esos proyectos a otro programador desde el administrador."
    );
}

// Datos de conexión: se mantienen sin modificar.
$project_ref = "lfxxzmufeikrboikbfuv";
$apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpcJ9UQ_RZ6Kkijf";

$url = "https://{$project_ref}.supabase.co/rest/v1/programador"
     . "?id_Programador=eq." . urlencode((string)$id);

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
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$errorCurl = curl_error($ch);

curl_close($ch);

if ($response !== false && $httpCode >= 200 && $httpCode < 300) {
    header("Location: admin.php");
    exit;
}

echo "<h3>No se pudo eliminar el programador.</h3>";
echo "<p>Código HTTP: " . (int)$httpCode . "</p>";
echo "<pre>";
echo htmlspecialchars(
    $errorCurl ?: ($response ?: "Error de conexión con Supabase.")
);
echo "</pre>";
echo "<a href='admin.php'>Volver al administrador</a>";

exit;
?>