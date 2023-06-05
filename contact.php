<?php
// Autorise toutes les origines (domaines) à accéder à cette API
header("Access-Control-Allow-Origin: *");

// Autorise les méthodes HTTP spécifiées (GET, POST, etc.)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Autorise les en-têtes personnalisés dans la requête
header("Access-Control-Allow-Headers: Content-Type");

// Spécifie la durée de validité des informations pré-cachées (en secondes)
header("Access-Control-Max-Age: 86400");

// Vérifie si la requête est une requête OPTIONS (pré-vérification)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Répond uniquement aux requêtes OPTIONS et arrête l'exécution du script
    http_response_code(200);
//     exit;
}

include "connexion.php";

// Récupérer les données JSON envoyées depuis React
$data = json_decode(file_get_contents("php://input"), true);
function secure_input($input) {

    $input = trim($input);
    $input = addslashes($input);
    $input = strip_tags($input);
    $input = nl2br($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}


//          echo '<pre>';
//     print_r($data);
//     echo '</pre>';
    
$telephone = secure_input($data['telephone']);
$email = secure_input($data['email']);
$message = secure_input($data['message']);


$sql = "INSERT INTO contact (telephone, email, message) VAlUES ('$telephone', '$email', '$message')";

if($conn->exec($sql)){
        echo "succès";

}else{
        echo "echec";
}
               
?>