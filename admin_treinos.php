<?php

require_once __DIR__ . '/includes/auth_admin.php';
require_once __DIR__ . '/conexao.php';

/*
|--------------------------------------------------------------------------
| Valores iniciais da página
|--------------------------------------------------------------------------
*/

$mensagem = '';
$editando = null;
$treinos = [];

$dias = [
    'SEG' => 'Segunda-feira',
    'TER' => 'Terça-feira',
    'QUA' => 'Quarta-feira',
    'QUI' => 'Quinta-feira',
    'SEX' => 'Sexta-feira',
    'SAB' => 'Sábado'
];

$niveis = [
    'iniciante' => 'Iniciante',
    'intermediario' => 'Intermediário',
    'avancado' => 'Avançado',
    'todos' => 'Todos'
];
// CREATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'salvar') {

    $dia = $_POST['dia'] ?? '';
    $titulo = trim($_POST['titulo'] ?? '');
    $horario = trim($_POST['horario'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $nivel = $_POST['nivel'] ?? 'todos';

    $stmt = $conn->prepare("
        INSERT INTO treinos (
            dia,
            titulo,
            horario,
            descricao,
            nivel
        )
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssss",
        $dia,
        $titulo,
        $horario,
        $descricao,
        $nivel
    );

    $stmt->execute();

    header('Location: admin_treinos.php');
    exit;
}


// UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'editar') {

    $id = (int) ($_POST['id'] ?? 0);

    $dia = $_POST['dia'] ?? '';
    $titulo = trim($_POST['titulo'] ?? '');
    $horario = trim($_POST['horario'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $nivel = $_POST['nivel'] ?? 'todos';

    $stmt = $conn->prepare("
        UPDATE treinos
        SET
            dia = ?,
            titulo = ?,
            horario = ?,
            descricao = ?,
            nivel = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "sssssi",
        $dia,
        $titulo,
        $horario,
        $descricao,
        $nivel,
        $id
    );

    $stmt->execute();

    header('Location: admin_treinos.php');
    exit;
}


// ── Excluir treino ──────────────────────────────────────

if (
    isset($_GET['action'], $_GET['id']) &&
    $_GET['action'] === 'delete'
) {

    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("
        DELETE FROM treinos
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: admin_treinos.php');
    exit;
}


// ── Carregar treino para edição ─────────────────────────

if (
    isset($_GET['action'], $_GET['id']) &&
    $_GET['action'] === 'edit'
) {

    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("
        SELECT *
        FROM treinos
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $editando = $stmt
        ->get_result()
        ->fetch_assoc();
}


// READ / LISTAGEM
$sql = "
    SELECT *
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
";

$resultado = $conn->query($sql);

$treinos = [];

while ($row = $resultado->fetch_assoc()) {
    $treinos[] = $row;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin – Treinos | StrikeSet Gaspar</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,600;0,700;1,700&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="visual/css/admin_treinos.css?v=<?php echo time(); ?>">

</head>
<body>

<?php require_once __DIR__ . '/includes/header_admin.php'; ?>

<main class="admin-content">

    <!-- Feedback -->
    <?php if ($mensagem): ?>
        <div class="alert-admin <?= $tipo_msg ?>">
            <?= $tipo_msg === 'success' ? '✅' : '⚠️' ?>
            <?= htmlspecialchars($mensagem) ?>
        </div>
    <?php endif; ?>

    <!-- Barra de Ações -->
    <div class="actions-bar">
        <h2>Gerenciar Treinos</h2>
        <a
    href="admin_treinos.php#form-treino"
    class="btn-admin btn-laranja"
>
    ＋ Novo Treino
</a>
    </div>

    <!-- ===== TABELA DE TREINOS ===== -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dia</th>
                    <th>Título</th>
                    <th>Horário</th>
                    <th>Nível</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($treinos)): ?>
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="icon">🏐</div>
                            <p>Nenhum treino cadastrado ainda. Crie o primeiro!</p>
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($treinos as $t): ?>
                <tr>
                    <td style="color:var(--cinza-texto);font-size:.85rem;"><?= $t['id'] ?></td>
                    <td><span class="tag-dia"><?= htmlspecialchars($t['dia']) ?></span></td>
                    <td style="font-weight:600;color:white;"><?= htmlspecialchars($t['titulo']) ?></td>
                    <td style="color:var(--cinza-texto);"><?= htmlspecialchars($t['horario']) ?></td>
                    <td>
                        <span class="tag-nivel <?= htmlspecialchars($t['nivel']) ?>">
                            <?= htmlspecialchars($niveis[$t['nivel']] ?? $t['nivel']) ?>
                        </span>
                    </td>
                    <td style="color:var(--cinza-texto);font-size:.9rem;max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        <?= htmlspecialchars($t['descricao']) ?>
                    </td>
                    <td>
    <div style="display:flex; gap:8px; flex-wrap:wrap;">

        <a
            href="admin_treinos.php?action=edit&id=<?= (int) $t['id'] ?>#form-treino"
            class="btn-admin btn-amarelo"
        >
            ✏️ Editar
        </a>

        <a
            href="admin_treinos.php?action=delete&id=<?= (int) $t['id'] ?>"
            class="btn-admin btn-vermelho"
            onclick="return confirm('Tem certeza que deseja excluir este treino?')"
        >
            🗑️ Excluir
        </a>

    </div>
</td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<!-- ===== FORMULÁRIO CRIAR / EDITAR ===== -->

<div class="form-card" id="form-treino">

    <h3>
        <?= $editando ? '✏️ Editar Treino' : '➕ Novo Treino' ?>
    </h3>

    <form method="POST" action="admin_treinos.php">

    <input
        type="hidden"
        name="acao"
        value="<?= $editando ? 'editar' : 'salvar' ?>"
    >

    <?php if ($editando): ?>

        <input
            type="hidden"
            name="id"
            value="<?= (int) $editando['id'] ?>"
        >

    <?php endif; ?>


        <div class="form-grid">

            <!-- DIA -->

            <div class="field-group">

                <label for="dia">
                    Dia <span class="req">*</span>
                </label>

                <select
                    id="dia"
                    name="dia"
                    required
                >

                    <option value="">
                        Selecione...
                    </option>

                    <?php foreach ($dias as $val => $label): ?>

                        <option
                            value="<?= $val ?>"
                            <?= (
                                $editando &&
                                $editando['dia'] === $val
                            ) ? 'selected' : '' ?>
                        >

                            <?= $val ?> – <?= $label ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- TÍTULO -->

            <div class="field-group">

                <label for="titulo">
                    Título <span class="req">*</span>
                </label>

                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    maxlength="100"
                    placeholder="Ex: Treino de fundamentos"
                    value="<?= htmlspecialchars($editando['titulo'] ?? '') ?>"
                    required
                >

            </div>


            <!-- HORÁRIO -->

            <div class="field-group">

                <label for="horario">
                    Horário <span class="req">*</span>
                </label>

                <input
                    type="text"
                    id="horario"
                    name="horario"
                    maxlength="30"
                    placeholder="Ex: 19h00 - 21h00"
                    value="<?= htmlspecialchars($editando['horario'] ?? '') ?>"
                    required
                >

            </div>


            <!-- NÍVEL -->

            <div class="field-group">

                <label for="nivel">
                    Nível <span class="req">*</span>
                </label>

                <select
                    id="nivel"
                    name="nivel"
                    required
                >

                    <option value="">
                        Selecione...
                    </option>

                    <?php foreach ($niveis as $val => $label): ?>

                        <option
                            value="<?= $val ?>"
                            <?= (
                                $editando &&
                                $editando['nivel'] === $val
                            ) ? 'selected' : '' ?>
                        >

                            <?= $label ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- DESCRIÇÃO -->

            <div class="field-group form-grid-full">

                <label for="descricao">
                    Descrição
                </label>

                <textarea
                    id="descricao"
                    name="descricao"
                    maxlength="500"
                    placeholder="Descreva o conteúdo do treino..."
                ><?= htmlspecialchars($editando['descricao'] ?? '') ?></textarea>

            </div>

        </div>


        <div class="form-actions">

            <?php if ($editando): ?>

                <button
                    type="submit"
                    class="btn-admin btn-laranja"
                >
                    💾 Salvar Alterações
                </button>

                <a
                    href="admin_treinos.php"
                    class="btn-admin btn-cinza"
                >
                    ✕ Cancelar
                </a>

            <?php else: ?>

                <button
                    type="submit"
                    class="btn-admin btn-laranja"
                >
                    ✚ Criar Treino
                </button>

            <?php endif; ?>

        </div>

    </form>

</div>

</div><!-- /form-card -->

</main>

<!-- ===== FOOTER ===== -->
<footer class="admin-footer">
    StrikeSet Gaspar &copy; <?= date('Y') ?> — Painel Administrativo
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Confirmação antes de excluir
    function confirmarExclusao(nome) {
        return confirm('Tem certeza que deseja excluir o treino "' + nome + '"?\nEssa ação não pode ser desfeita.');
    }

    // Rolar até o formulário ao clicar em Editar
    function rolarParaForm() {
        setTimeout(() => {
            const el = document.getElementById('form-treino');
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }

    // Rolar até o formulário ao clicar em Novo Treino
    function abrirFormNovo() {
        setTimeout(() => {
            const el = document.getElementById('form-treino');
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }

    // Auto-fechar mensagem de feedback após 4 segundos
    const alertEl = document.querySelector('.alert-admin');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.transition = 'opacity .5s';
            alertEl.style.opacity = '0';
            setTimeout(() => alertEl.remove(), 500);
        }, 4000);
    }

    // Rolar automaticamente até o form se veio de uma ação de edição
    <?php if ($editando): ?>
        window.addEventListener('DOMContentLoaded', () => {
            document.getElementById('form-treino')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    <?php endif; ?>
</script>

</body>
</html>

