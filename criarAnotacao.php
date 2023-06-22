<?php

include "verificarLogin.php";

$campos = ['titulo', 'conteudo'];
$valido = True;

foreach ($campos as $campo) {
    if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
        $valido = false;
        break;
    }
}

if (isset($_POST['enviar']) && $valido) {
    include "conexao.php";
    $sql = $pdo->prepare("INSERT INTO anotacoes VALUES (null, ?, ?, ?)");
    $sql->execute(array($_SESSION['dados']['id'], $_POST['titulo'], $_POST['conteudo']));
    header('Location: feed.php');
    exit;
};

?>

<h1>Criando nova nota</h1>

<form method="POST">
    <label>Título</label><br>
    <input placeholder="Insira um título..." name="titulo" type="text"><br>
    <label>Sobre</label><br>
    <textarea id="" cols="30" rows="10" placeholder="Digite sobre..." name="conteudo"></textarea><br>
    <input type="submit" value="Enviar" name="enviar">
    <a href='feed.php'>Cancelar</a>
</form>