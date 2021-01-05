<?php
DEFINE("USER","root");
DEFINE("PASSWORD","root");
try{
    $verbinding = new
    pdo("mysql:host=localhost;dbname=webshop",USER,PASSWORD);
    $verbinding->setAttribute
    (PDO::ATTR_ERRORMODE,PDO::ERRORMODE_EXCEPTION );
}catch(PDOException $e) {
    echo $e->getMessage();
    echo "kon geen verbinding maken.";
}
?>