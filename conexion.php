<?php
function consultarSupabase($endpoint, $metodo = 'GET', $datos = null) {
    $project_ref = "lfxxzmufeikrboikbfuv";
    $apiKey = "sb_publishable_PBpZSvDoTFT2CYKtpcJ9UQ_RZ6Kkijf"; // Tu API Key
    
    // Construir la URL completa del recurso
    $url = "https://{$project_ref}.supabase.co/rest/v1/" . $endpoint;

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

    // Si la petición es POST (para guardar datos)
    if (strtoupper($metodo) === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Retorna la respuesta convertida en arreglo PHP
    return json_decode($response, true);
}
?>