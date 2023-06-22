<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=sistema_login','root','');
    //$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Erro: " . $e->getMessage();
}

?>