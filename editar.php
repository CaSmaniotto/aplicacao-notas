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

if ($_GET['id_anotacao']) {
    include "conexao.php";
    $id_anotacao = (int)$_GET['id_anotacao'];
    $id_usuario = $_SESSION['dados']['id'];

    $sql = $pdo->prepare("SELECT * FROM anotacoes WHERE id_usuario=? AND id=?");
    $sql->execute([$id_usuario, $id_anotacao]); 
    $anotacoes = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$anotacoes) {
        header('Location: feed.php');
        exit;
    };
    
    if (isset($_POST['enviar']) && $valido) {
        $sql = $pdo->prepare("UPDATE anotacoes SET titulo=?, conteudo=? WHERE id=?");
        $sql->execute(array($_POST['titulo'], $_POST['conteudo'], $id_anotacao));
        header('Location: feed.php');
        exit;
    };

} else {
    header('Location: feed.php');
    exit;
};

?>

<h1>Editando nota</h1>
<form method="POST">
    <label for="">Título</label><br>
    <input type="text" name="titulo" value="<?php echo $anotacoes['titulo']; ?>"><br>
    <label for="">Conteúdo</label><br>
    <textarea name="conteudo" id="" cols="30" rows="10"><?php echo $anotacoes['conteudo']; ?></textarea><br>
    <input type="submit" name="enviar" value="Atualizar">
</form>