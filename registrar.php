<?php

$campos = ['nome', 'email', 'senha'];
$valido = true;

foreach ($campos as $campo) {
    if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
        $valido = false;
        break;
    }
}

if (isset($_POST['enviar']) && $valido) {
    include "conexao.php";
    $sql = $pdo->prepare("INSERT INTO usuarios VALUES (null, ?, ?, ?)");
    $sql->execute(array($_POST['nome'], $_POST['email'], md5($_POST['senha'])));
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
</head>
<body>
    <form method="POST">
        <label for="">Nome</label>
        <input type="text" name="nome" required>
        <label for="">Email</label>
        <input type="email" name="email" required>
        <label for="">Senha</label>
        <input type="password" name="senha" required>
        <input type="submit" value="Enviar" name="enviar">
    </form>
    <a href="index.php">Voltar</a> |
    <a href="login.php">Já possuí conta ?</a>
</body>
</html>