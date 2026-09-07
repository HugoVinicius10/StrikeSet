<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/conexao.php';

$erro = '';
$sucesso = '';

if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'sucesso') {
    $sucesso = 'Cadastro realizado com sucesso! Faça seu login.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acao = $_POST['acao'] ?? '';

    /*
    |--------------------------------------------------------------------------
    | CADASTRO
    |--------------------------------------------------------------------------
    */

    if ($acao === 'cadastro') {

        $nome  = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($nome === '' || $email === '' || $senha === '') {

            $erro = 'Preencha todos os campos.';

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $erro = 'E-mail inválido.';

        } elseif (strlen($senha) < 6) {

            $erro = 'A senha deve possuir pelo menos 6 caracteres.';

        } else {

            $stmt = $conn->prepare("
                SELECT id
                FROM usuarios
                WHERE email = ?
                LIMIT 1
            ");

            $stmt->bind_param("s", $email);
            $stmt->execute();

            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {

                $erro = 'Este e-mail já está cadastrado.';

            } else {

                $senhaHash = password_hash(
                    $senha,
                    PASSWORD_DEFAULT
                );

                $stmt = $conn->prepare("
                    INSERT INTO usuarios
                    (
                        nome,
                        email,
                        senha,
                        tipo,
                        ativo
                    )
                    VALUES (?, ?, ?, 'usuario', 1)
                ");

                $stmt->bind_param(
                    "sss",
                    $nome,
                    $email,
                    $senhaHash
                );

                if ($stmt->execute()) {

                    header(
                        'Location: login.php?cadastro=sucesso'
                    );

                    exit;

                } else {

                    $erro = 'Erro ao cadastrar usuário.';
                }
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    if ($acao === 'login') {

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        $stmt = $conn->prepare("
            SELECT
                id,
                nome,
                email,
                senha,
                tipo,
                ativo
            FROM usuarios
            WHERE email = ?
            LIMIT 1
        ");

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if (!$usuario) {

            $erro = 'E-mail ou senha inválidos.';

        } elseif (!password_verify($senha, $usuario['senha'])) {

            $erro = 'E-mail ou senha inválidos.';

        } elseif (!$usuario['ativo']) {

            $erro = 'Usuário desativado.';

        } else {

            session_regenerate_id(true);

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];

            if ($usuario['tipo'] === 'admin') {

                header('Location: admin_treinos.php');

            } else {

                header('Location: home.php');
            }

            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StrikeSet Gaspar - Login/Cadastro</title>
    <link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="visual/css/login.css?v=<?php echo time(); ?>">
</head>
<body>

    <?php require_once __DIR__ . '/includes/header.php'; ?>

    <main class="auth-container">

      <?php if ($erro): ?>
     <div class="alert alert-danger">
        <?= htmlspecialchars($erro) ?>
     </div>
      <?php endif; ?>
      <?php if ($sucesso): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($sucesso) ?>
    </div>
      <?php endif; ?>
      
        <div class="hero-img">
            <img src="visual/images/jogador.png" alt="Jogadora de vôlei">
        </div>

        <div class="auth-card">

    <h2>Login</h2>

    <p class="subtitle">
        Entre na sua conta StrikeSet
    </p>

    <form class="auth-form" method="POST" action="login.php">

        <input
            type="hidden"
            name="acao"
            value="login"
        >

        <div class="form-group">
            <label for="login-email">E-mail</label>

            <input
                type="email"
                id="login-email"
                name="email"
                placeholder="seu@email.com"
                required
            >
        </div>

        <div class="form-group">
            <label for="login-senha">Senha</label>

            <input
                type="password"
                id="login-senha"
                name="senha"
                placeholder="Digite sua senha"
                required
            >
        </div>

        <button type="submit" class="btn-auth">
            Entrar
        </button>

    </form>

    <div class="text-small">
        <a href="#">Esqueceu a senha?</a>
    </div>

</div>

<div class="auth-card">

    <h2>Cadastro</h2>

    <p class="subtitle">
        Faça parte da comunidade StrikeSet
    </p>

    <form class="auth-form" method="POST" action="login.php">

        <input
            type="hidden"
            name="acao"
            value="cadastro"
        >

        <div class="form-group">
            <label for="cadastro-nome">Nome</label>

            <input
                type="text"
                id="cadastro-nome"
                name="nome"
                placeholder="Digite seu nome"
                required
            >
        </div>

        <div class="form-group">
            <label for="cadastro-email">E-mail</label>

            <input
                type="email"
                id="cadastro-email"
                name="email"
                placeholder="seu@email.com"
                required
            >
        </div>

        <div class="form-group">
            <label for="cadastro-senha">Senha</label>

            <input
                type="password"
                id="cadastro-senha"
                name="senha"
                placeholder="Crie uma senha"
                required
            >
        </div>

        <button type="submit" class="btn-auth">
            Cadastrar
        </button>

    </form>

    <div class="text-small">
        Ao se cadastrar, você concorda com nossos
        <a href="#">termos</a>.
    </div>
</div>
    </main>

    <?php require_once __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
