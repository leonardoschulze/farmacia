<?php

$mysqli = new mysqli("localhost", "root", "root", "farmacia");
if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["nome"] ?? "";
    $pass = $_POST["senha"] ?? "";

    $stmt = $mysqli->prepare("SELECT id, nome, senha FROM usuario WHERE nome=? AND senha=?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();

    if ($dados) {
        $_SESSION["id"] = $dados["id"];
        $_SESSION["nome"] = $dados["nome"];
        header("Location: projeto/menu.php");
        exit;
    } else {
        $msg = "Usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

<?php if (!empty($_SESSION["id"])): ?>
  <div class="card">
    <h3>Bem-vindo, <?= htmlspecialchars($_SESSION["nome"]) ?>!</h3>
    <p>Sessão ativa.</p>
    <p><a href="?logout=true">Sair</a></p>
  </div>

<?php else: ?>
  <div class="card">
    <h2>Bem-Vindo</h2>
    <?php if ($msg): ?><p class="msg"><?= htmlspecialchars($msg) ?></p><?php endif; ?>

    <form method="post">
      <div class="loguim">
        <div class="user">
          <input type="text" name="nome" placeholder="Usuário" required>
        </div>
        <div class="senh">
          <input type="password" name="senha" placeholder="Senha" required>
        </div>
      </div>
      <button type="submit">Entrar</button>
      <br>
    </form>

    <p><small>Dica: Leo / leo123</small></p>
  </div>
<?php endif; ?>

</body>
</html>