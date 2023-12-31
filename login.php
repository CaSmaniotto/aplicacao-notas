<?php

session_start();

if(isset($_SESSION['logado']) && $_SESSION["logado"] == true) {
    header('Location: feed.php');
    exit;
}

if (isset($_POST['logar'])) {
    include "conexao.php";
    try {
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email=?");
        $sql->execute(array($_POST['email'])); 
        $dados = $sql->fetch(PDO::FETCH_ASSOC);

        if (password_verify($_POST['senha'], $dados['senha'])) {
            $_SESSION['logado'] = true;
            $_SESSION['dados'] = array('id' => $dados['id'],
                                       'nome' => $dados['nome'],
                                       'email' => $dados['email']);
            header('Location: feed.php');
            exit;
        } else {
            echo "Email ou senha incorretos!";
        }
    } catch(Exception $e) {
        echo "Erro!", $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <label for="">Email</label>
        <input type="email" name="email" required>
        <label for="">Senha</label>
        <input type="password" name="senha" required>
        <input type="submit" value="Enviar" name="logar">
    </form>
    <a href="index.php">Voltar</a> |
    <a href="registrar.php">Crie sua conta</a>
</body>
</html>
