<?php
//class conntection {
    
define('DB_SERVER', 'joey01245.nl');
define('DB_USERNAME', 'joeynl_wp2');
define('DB_PASSWORD', 'joey012451');
define('DB_NAME', 'joeynl_pizzaALA');
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
    
//}
?>