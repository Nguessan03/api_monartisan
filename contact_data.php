<?php
// Autorise toutes les origines ( domaines ) à accéder à cette API
header( 'Access-Control-Allow-Origin: *' );

// Autorise les méthodes HTTP spécifiées ( GET, POST, etc. )
header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );

// Autorise les en-têtes personnalisés dans la requête
header( 'Access-Control-Allow-Headers: Content-Type' );

// Spécifie la durée de validité des informations pré-cachées ( en secondes )
header( 'Access-Control-Max-Age: 86400' );

// Vérifie si la requête est une requête OPTIONS ( pré-vérification )
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'OPTIONS' ) {
    // Répond uniquement aux requêtes OPTIONS et arrête l'exécution du script
    http_response_code(200);
//     exit;
}

// Reponse de la requete avec les données json
header( 'Content-type: application/json' );

require_once('connexion.php' );

    $sql = 'SELECT * FROM  contact';
    $result = $conn->query( $sql );

    $data = [];

    if ( $result->rowCount() > 0 ) {

        while( $row = $result->fetch() ) {

            $data[] = $row;
        }

    }
    
    echo json_encode($data);
    ?>