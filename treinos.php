<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/conexao.php';

$mensagemInscricao = '';
$tipoMensagem = '';

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    ($_POST['acao'] ?? '') === 'inscrever'
) {

    if (!isset($_SESSION['usuario_id'])) {

        header('Location: login.php');
        exit;
    }

    $usuarioId = (int) $_SESSION['usuario_id'];
    $treinoId = (int) ($_POST['treino_id'] ?? 0);
    $telefone = trim($_POST['telefone'] ?? '');

    if ($treinoId <= 0) {

        $mensagemInscricao = 'Selecione um treino.';
        $tipoMensagem = 'erro';

    } else {

        $stmt = $conn->prepare("
            SELECT id
            FROM treinos
            WHERE id = ?
        ");

        $stmt->bind_param("i", $treinoId);
        $stmt->execute();

        $treinoExiste = $stmt
            ->get_result()
            ->fetch_assoc();

        if (!$treinoExiste) {

            $mensagemInscricao = 'Treino inválido.';
            $tipoMensagem = 'erro';

        } else {

            $stmt = $conn->prepare("
                SELECT id
                FROM inscricoes_treino
                WHERE usuario_id = ?
                  AND treino_id = ?
                LIMIT 1
            ");

            $stmt->bind_param(
                "ii",
                $usuarioId,
                $treinoId
            );

            $stmt->execute();

            if ($stmt->get_result()->num_rows > 0) {

                $mensagemInscricao =
                    'Você já está inscrito neste treino.';

                $tipoMensagem = 'erro';

            } else {

                $stmt = $conn->prepare("
                    INSERT INTO inscricoes_treino (
                        usuario_id,
                        treino_id,
                        telefone
                    )
                    VALUES (?, ?, ?)
                ");

                $stmt->bind_param(
                    "iis",
                    $usuarioId,
                    $treinoId,
                    $telefone
                );

                $stmt->execute();

                $mensagemInscricao =
                    'Inscrição realizada com sucesso!';

                $tipoMensagem = 'sucesso';
            }
        }
    }
}

$resultado = $conn->query("
    SELECT
        id,
        dia,
        titulo,
        horario,
        descricao,
        nivel
    FROM treinos
    ORDER BY
        FIELD(
            dia,
            'SEG',
            'TER',
            'QUA',
            'QUI',
            'SEX',
            'SAB'
        ),
        horario
");

$treinos = [];

while ($row = $resultado->fetch_assoc()) {
    $treinos[] = $row;
}

$niveis = [
    'iniciante' => 'Iniciante',
    'intermediario' => 'Intermediário',
    'avancado' => 'Avançado',
    'todos' => 'Todos os níveis'
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Treinos | StrikeSet Gaspar</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="visual/css/treinos.css?v=<?php echo time(); ?>">
</head>
<body>

<?php require_once __DIR__ . '/includes/header.php'; ?>

<section class="treinos-section">

    <div class="treinos-header">
        <h1>Nossos Treinos</h1>
        <p>
            Confira o cronograma semanal do StrikeSet Gaspar e garanta sua vaga no próximo treino!
        </p>
        <div class="local-info">
             Ginásio do IFSC Gaspar
        </div>
    </div>

    <h2 class="section-title">Cronograma Semanal</h2>

    <div class="cronograma-grid">

        <?php if (empty($treinos)): ?>

    <p class="sem-registros">
        Nenhum treino cadastrado no momento.
    </p>

<?php else: ?>

    <?php foreach ($treinos as $treino): ?>

        <div class="treino-card">

            <div class="dia-tag">
                <?= htmlspecialchars($treino['dia']) ?>
            </div>

            <div class="treino-card-body">

                <h5>
                    <?= htmlspecialchars($treino['titulo']) ?>
                </h5>

                <p class="horario">
                    <?= htmlspecialchars($treino['horario']) ?>
                </p>

                <p class="descricao">
                    <?= htmlspecialchars($treino['descricao'] ?? '') ?>
                </p>

                <span class="nivel <?= htmlspecialchars($treino['nivel']) ?>">
                    <?= htmlspecialchars(
                        $niveis[$treino['nivel']] ?? $treino['nivel']
                    ) ?>
                </span>

            </div>

        </div>

    <?php endforeach; ?>

<?php endif; ?>

    </div>

    <div class="inscricao-wrapper">
        <div class="inscricao-card">
            <h2>Inscreva-se em um Treino</h2>
            <p class="inscricao-sub">Preencha os dados abaixo e garanta sua vaga.</p>

            <form
    id="formInscricao"
    class="inscricao-form"
    method="POST"
    action="treinos.php"
>

    <input
        type="hidden"
        name="acao"
        value="inscrever"
    >

    <?php if ($mensagemInscricao): ?>
        <p class="form-feedback <?= htmlspecialchars($tipoMensagem) ?>">
            <?= htmlspecialchars($mensagemInscricao) ?>
        </p>
    <?php endif; ?>

    <div class="form-row">
        <div class="form-group">
            <label for="telefone">
                Telefone (WhatsApp)
            </label>

            <input
                type="tel"
                id="telefone"
                name="telefone"
                maxlength="20"
                required
            >
        </div>
    </div>

    <div class="form-group">
        <label for="treino">
            Qual treino você quer fazer?
        </label>

        <select
            id="treino"
            name="treino_id"
            required
        >
            <option value="">
                Selecione um treino...
            </option>

            <?php foreach ($treinos as $treino): ?>

                <option value="<?= (int) $treino['id'] ?>">
                    <?= htmlspecialchars($treino['dia']) ?>
                    -
                    <?= htmlspecialchars($treino['titulo']) ?>
                    -
                    <?= htmlspecialchars($treino['horario']) ?>
                </option>

            <?php endforeach; ?>

        </select>
    </div>

    <button
        type="submit"
        class="btn-inscrever"
    >
        QUERO ME INSCREVER
    </button>

</form>
        </div>
    </div>

</section>

<footer>
    <p>StrikeSet Gaspar</p>
    <div>
        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/instagram.svg" alt="Instagram">
        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/x.svg" alt="Twitter">
        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/whatsapp.svg" alt="WhatsApp">
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
