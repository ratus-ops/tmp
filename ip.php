<?php
// Autoriser CORS
header('Access-Control-Allow-Origin: *');  // Remplace '*' par l'URL de ton site pour plus de sécurité
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$clientIp = $_SERVER['REMOTE_ADDR'];

// URL de l'API non sécurisée (HTTP)
$apiUrl = 'http://ip-api.com/json/';

// Effectuer la requête à l'API HTTP
$response = file_get_contents($apiUrl);

// Vérifier si la requête a réussi
if ($response === FALSE) {
    // Si une erreur se produit, renvoyer une erreur JSON
    header('Content-Type: application/json');
    echo json_encode(["error" => "Erreur lors de la récupération des données"]);
    exit();
}

// Renvoyer la réponse avec le bon type MIME
header('Content-Type: application/json');
echo $response;
