<?php

session_start();

if (isset($_POST['logar'])) {
    include "conexao.php";
    try {
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email=:email AND senha=:senha");
        $sql->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $sql->bindValue(':senha',  md5($_POST['senha']), PDO::PARAM_STR);
        $sql->execute();
        $dados = $sql->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            $_SESSION['logado'] = true;
            $_SESSION['dados'] = array('id' => $dados['id'],
                                       'nome' => $dados['nome'],
                                       'email' => $dados['email']);
            header('Location: feed.php');
            exit;
        }
        else {
            echo "Email ou senha incorretos!";
        }
    } catch(Exception $e)  {
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