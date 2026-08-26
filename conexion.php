<?php
$project_ref = "lfxxzmufeikrboikbfuv";
$apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpcJ9UQ_RZ6Kkijf"; // Reemplaza por tu Publishable Key completa

$url = "https://lfxxzmufeikrboikbfuv.supabase.co/rest/v1/";

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "apikey: {$apiKey}",
        "Authorization: Bearer {$apiKey}"
    ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);


if ($httpCode === 200 || $httpCode === 401) {
    echo "<h1>Conexión exitosa</h1>";
} else {
    echo "<h1>Error en la conexión</h1>";
}
?>