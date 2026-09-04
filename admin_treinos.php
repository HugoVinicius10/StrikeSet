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
<link rel="stylesheet" href="admin_treinos.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

<style>
/* ===== VARIÁVEIS ===== */
:root {
    --laranja:        #f97316;
    --laranja-escuro: #c2590f;
    --preto:          #0d0d0d;
    --preto-claro:    #161616;
    --cinza-escuro:   #1e1e1e;
    --cinza-medio:    #333;
    --cinza-texto:    #aaa;
    --verde:          #22c55e;
    --azul:           #3b82f6;
    --vermelho:       #ef4444;
    --amarelo:        #eab308;
}

/* ===== BASE ===== */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--preto);
    color: #e5e5e5;
    font-family: 'Barlow', sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ===== HEADER ===== */
.admin-header {
    background: var(--preto-claro);
    border-bottom: 3px solid var(--laranja);
    padding: 18px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 100;
}

.admin-header .brand {
    display: flex;
    align-items: center;
    gap: 14px;
}

.admin-header .brand .badge-admin {
    background: var(--laranja);
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-weight: 700;
    font-size: 0.7rem;
    letter-spacing: 2px;
    padding: 3px 10px;
    border-radius: 4px;
    text-transform: uppercase;
}

.admin-header h1 {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 1.6rem;
    font-weight: 700;
    font-style: italic;
    color: white;
    line-height: 1;
}

.admin-header h1 span { color: var(--laranja); }

.btn-logout {
    background: transparent;
    border: 1px solid var(--cinza-medio);
    color: var(--cinza-texto);
    padding: 6px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    text-decoration: none;
    transition: .2s;
}
.btn-logout:hover { border-color: var(--vermelho); color: var(--vermelho); }

/* ===== CONTEÚDO PRINCIPAL ===== */
.admin-content {
    flex: 1;
    padding: 40px;
    max-width: 1400px;
    width: 100%;
    margin: 0 auto;
}

/* ===== MENSAGEM DE FEEDBACK ===== */
.alert-admin {
    padding: 14px 20px;
    border-radius: 8px;
    margin-bottom: 28px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: slideDown .3s ease;
}

.alert-admin.success {
    background: rgba(34,197,94,.15);
    border: 1px solid var(--verde);
    color: var(--verde);
}

.alert-admin.danger {
    background: rgba(239,68,68,.15);
    border: 1px solid var(--vermelho);
    color: var(--vermelho);
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ===== BARRA DE AÇÕES ===== */
.actions-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 14px;
}

.actions-bar h2 {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 1.8rem;
    font-weight: 700;
    font-style: italic;
    color: white;
    position: relative;
    padding-bottom: 8px;
}

.actions-bar h2::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 50px; height: 3px;
    background: var(--laranja);
    border-radius: 2px;
}

/* ===== BOTÕES ===== */
.btn-admin {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 18px;
    border-radius: 7px;
    font-weight: 600;
    font-size: 0.88rem;
    letter-spacing: .5px;
    cursor: pointer;
    transition: .2s;
    border: none;
    text-decoration: none;
}

.btn-admin:hover { transform: translateY(-2px); filter: brightness(1.1); }

.btn-verde   { background: var(--verde);    color: #fff; }
.btn-amarelo { background: var(--amarelo);  color: #111; }
.btn-vermelho { background: var(--vermelho); color: #fff; }
.btn-laranja { background: var(--laranja);  color: #fff; }
.btn-cinza   { background: var(--cinza-medio); color: #ddd; }

/* ===== TABELA ===== */
.table-wrapper {
    background: var(--cinza-escuro);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #2a2a2a;
    margin-bottom: 40px;
    animation: fadeIn .4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

.table-wrapper table {
    width: 100%;
    border-collapse: collapse;
}

.table-wrapper thead {
    background: var(--preto-claro);
    border-bottom: 2px solid var(--laranja);
}

.table-wrapper thead th {
    padding: 14px 18px;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--laranja);
    white-space: nowrap;
}

.table-wrapper tbody tr {
    border-bottom: 1px solid #252525;
    transition: background .15s;
}

.table-wrapper tbody tr:last-child { border-bottom: none; }
.table-wrapper tbody tr:hover { background: rgba(249,115,22,.05); }

.table-wrapper tbody td {
    padding: 14px 18px;
    font-size: 0.95rem;
    color: #ddd;
    vertical-align: middle;
}

/* Tag do Dia */
.tag-dia {
    background: var(--laranja);
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-weight: 700;
    font-size: 0.8rem;
    letter-spacing: 2px;
    padding: 4px 10px;
    border-radius: 5px;
    display: inline-block;
}

/* Tags de Nível */
.tag-nivel {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.tag-nivel.iniciante    { background: rgba(34,197,94,.15);  color: #22c55e; border: 1px solid #22c55e; }
.tag-nivel.intermediario{ background: rgba(59,130,246,.15); color: #3b82f6; border: 1px solid #3b82f6; }
.tag-nivel.avancado     { background: rgba(239,68,68,.15);  color: #ef4444; border: 1px solid #ef4444; }
.tag-nivel.todos        { background: rgba(249,115,22,.15); color: var(--laranja); border: 1px solid var(--laranja); }

/* Tabela vazia */
.empty-state {
    padding: 60px 20px;
    text-align: center;
    color: var(--cinza-texto);
}

.empty-state .icon { font-size: 3rem; margin-bottom: 12px; opacity: .4; }
.empty-state p { font-size: 1rem; }

/* ===== FORMULÁRIO ===== */
.form-card {
    background: var(--cinza-escuro);
    border-radius: 12px;
    border-top: 4px solid var(--laranja);
    padding: 36px 36px 40px;
    animation: fadeIn .4s ease;
}

.form-card h3 {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    font-style: italic;
    color: var(--laranja);
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-grid-full {
    grid-column: 1 / -1;
}

.field-group {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.field-group label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #ccc;
    letter-spacing: .5px;
    text-transform: uppercase;
}

.field-group label .req { color: var(--laranja); }

.field-group input,
.field-group select,
.field-group textarea {
    background: var(--preto-claro);
    border: 1px solid var(--cinza-medio);
    color: white;
    padding: 11px 14px;
    border-radius: 7px;
    font-size: 0.95rem;
    font-family: 'Barlow', sans-serif;
    transition: .2s;
    outline: none;
    width: 100%;
}

.field-group input:focus,
.field-group select:focus,
.field-group textarea:focus {
    border-color: var(--laranja);
    box-shadow: 0 0 0 3px rgba(249,115,22,.15);
}

.field-group select option { background: #1a1a1a; }

.field-group textarea { resize: vertical; min-height: 90px; }

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 10px;
}

/* ===== FOOTER ===== */
.admin-footer {
    text-align: center;
    padding: 20px;
    color: var(--cinza-texto);
    font-size: 0.8rem;
    border-top: 1px solid #1f1f1f;
}

/* ===== RESPONSIVO ===== */
@media (max-width: 768px) {
    .admin-content  { padding: 24px 16px; }
    .form-grid      { grid-template-columns: 1fr; }
    .admin-header   { padding: 14px 20px; flex-wrap: wrap; gap: 10px; }
    .table-wrapper  { overflow-x: auto; }
    .actions-bar    { flex-direction: column; align-items: flex-start; }
}
</style>
</head>
<body>

<!-- ===== HEADER ===== -->
<header>
    <h2>StrikeSet Gaspar</h2>

    <nav>
        <a href="home.php">Inicio</a>
        <a href="admin_galeria.php">Galeria</a>
        <a href="sobre.php">Sobre</a>
        <a href="admin_treinos.php" class="active">Treinos</a>
        <a href="campeonatos.php">Campeonatos</a>

        <span class="admin-badge">PAINEL ADMIN</span>

    </nav>
</header>

<!-- ===== CONTEÚDO PRINCIPAL ===== -->
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

