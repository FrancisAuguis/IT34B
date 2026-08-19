<?php
session_start();

define('BASE_URL','http://localhost/it34');

define('DB_HOST','Localhost');
define('DB_NAME','it34b_lab_');
define('DB_USER','root');
define('DB_PASS','');

try{
    $pdo =new PDO(
        "mysql:host" .DB_HOST . ";dbname=" .DB_NAME, DB_USER, DB_PASS,
        [PDO::AFTER_ERRMODE => PDO::ERMODE_EXCEPTION]
    );
}catch(PDOException $e){
    die("Connection failed:"  .$e->getMessage());
}