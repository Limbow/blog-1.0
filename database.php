<?php 

$dsn = 'mysql:host=localhost;port=3306;dbname=blog';

$server= 'localhost';
$username = 'root';
$password = 'root';
$database = 'blog';

$dsn_options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $conn = new PDO($dsn, $username, $password, $dsn_options );
   /*  $conn = mysqli_connect($server, $username, $password, $database, 3306); */
} catch (Exception $e) {
    die('Connection Failed: '.$e->getMessage());
}



?>