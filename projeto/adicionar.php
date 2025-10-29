<?php
$mysqli = new mysqli("localhost", "root", "root", "farmacia");
if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

session_start();


if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_remedio'])) {
    $id = intval($_POST['id_remedio']);
    $nome = $_POST['username'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    

    $sql = "UPDATE remedio 
            SET username=?, quantidade=?, descricao=?, preco=?
            WHERE id_remedio=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssi", $username, $quantidade, $descricao, $preco, $id);

    if ($stmt->execute()) {
        $mensagem = "Usuário atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar: " . $mysqli->error;
    }
}

$usuario_edit = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM remedio WHERE id_remedio=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario_edit = $result->fetch_assoc();

    if (!$usuario_edit) {
        die("Usuário não encontrado!");
    }
}

$sql = "SELECT id_remedio, username, quantidade, descricao, preco FROM remdio";
$result = $mysqli->query($sql);

if (!$result) {
    die("Erro na consulta: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Remédio</title>
</head>
<body>
    <h1>Gerenciar Remédio</h1>
    <a href="menu.php">Voltar</a>

    <?php if (isset($mensagem)) echo "<p><strong>$mensagem</strong></p>"; ?>

    <h2>Usuários Cadastrados</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>quantidade</th>
            <th>descrição</th>
            <th>Preço</th>
        </tr>

        <?php while ($usuario = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $remedio['id_remedio'] ?></td>
                <td><?= $remedio['username'] ?></td>
                <td><?= $remedio['quantidade'] ?></td>
                <td><?= $remedio['descricao'] ?></td>
                <td><?= $remedio['preco'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $usuario['id_usuario'] ?>">✏️ Editar</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php if ($usuario_edit) { ?>
        <hr>
        <h2>Editar Usuário (ID <?= $usuario_edit['id_usuario'] ?>)</h2>

        <form method="POST" action="editar.php">
            <input type="hidden" name="id_usuario" value="<?= $usuario_edit['id_usuario'] ?>">

            <label>Nome:</label><br>
            <input type="text" name="username" value="<?= htmlspecialchars($usuario_edit['username']) ?>" required><br><br>

            <label>Tipo:</label><br>
            <input type="text" name="tipo_usuario" value="<?= htmlspecialchars($usuario_edit['tipo_usuario']) ?>" required><br><br>

            <label>Cargo:</label><br>
            <input type="text" name="cargo" value="<?= htmlspecialchars($usuario_edit['cargo']) ?>" required><br><br>

            <label>Senha:</label><br>
            <input type="text" name="senha" value="<?= htmlspecialchars($usuario_edit['senha']) ?>" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario_edit['email']) ?>" required><br><br>

            <button type="submit">💾 Salvar Alterações</button>
        </form>
    <?php } ?>

</body>
</html>
