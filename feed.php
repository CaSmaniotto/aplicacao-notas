<?php

include "verificarLogin.php";
include "conexao.php";

// echo "<h1>Bem vindo ". $_SESSION['dados']['nome'] ."</h1>";
echo "<h1>Bem vindo ". $_SESSION['dados']['nome'] ."</h1>";
echo "<a href='criarAnotacao.php'>Adicionar nota</a> |";
echo "<a href='logout.php'>Sair</a> <br>";

$id_usuario = $_SESSION['dados']['id'];
$sql = $pdo->prepare("SELECT * FROM anotacoes WHERE id_usuario=?");
$sql->execute([$id_usuario]); 
$anotacoes = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($anotacoes): ?>
    <p>Suas anotações</p>

    <table>
        <tr>
            <th>Título</th>
            <th>Conteúdo</th>
        </tr>

        <?php foreach ($anotacoes as $anotacao): ?>
            <tr>
                <td><?= $anotacao['titulo'] ?></td>
                <td><?= $anotacao['conteudo'] ?></td>
                <td><a href="editar.php?id_anotacao=<?= $anotacao['id'] ?>">Editar</a></td>
                <td><a href="excluir.php?id_anotacao=<?= $anotacao['id'] ?>">Excluir</a></td>
            </tr>
        <?php endforeach ?>
    </table>

<?php else: ?>
    <p>Não há nada aqui ainda</p>
<?php endif ?>
