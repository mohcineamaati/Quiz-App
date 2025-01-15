<?php

$host = 'localhost'; 
$dbname = 'app'; 
$username = 'root'; 
$password = ''; 


$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES => false, 
];

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
 
} catch (PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
}
?>