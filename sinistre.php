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
function secure_input($input) {

    $input = trim($input);
    $input = addslashes($input);
    $input = strip_tags($input);
    $input = nl2br($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

$data = json_decode(file_get_contents("php://input"), true);

$assurance = secure_input($data['assurance']);
$numero = secure_input($data['numero']);
$nomprenom = secure_input($data['nomprenom']);
$email = secure_input($data['email']);
$contact1 = secure_input($data['contact1']);
$contact2 = secure_input($data['contact2']);
$lieu = secure_input($data['lieu']);
$intervention = secure_input($data['intervention']);
$date = secure_input($data['date']);
$details = secure_input($data['details']);

$sql = "INSERT INTO sinistre (assurance, numero, nomprenom, email, contact1, contact2, lieu, intervention, date, details) VALUES('$assurance', '$numero', '$nomprenom', '$email', '$contact1', '$contact2', '$lieu', '$intervention', '$date', '$details')";

if($conn->exec($sql)){
        echo "succès";
}else{
        echo "echec";
}
                
?>