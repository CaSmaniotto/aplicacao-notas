<?php

include "verificarLogin.php";

if (isset($_GET['id_anotacao'])) {
    include "conexao.php";
    
    $id_anotacao = (int)$_GET['id_anotacao'];
    $id_usuario = $_SESSION['dados']['id'];

    $sql = $pdo->prepare("SELECT * FROM anotacoes WHERE id_usuario=? AND id=?");
    $sql->execute([$id_usuario, $id_anotacao]); 
    $anotacoes = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($anotacoes) {
        $sql = $pdo->prepare("DELETE FROM anotacoes WHERE id=?");
        $sql->execute([$id_anotacao]);
        header('Location: feed.php');
        exit;
    };

}

header('Location: feed.php');
exit;

?>