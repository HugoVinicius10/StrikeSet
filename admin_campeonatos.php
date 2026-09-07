<?php

require_once __DIR__ . '/includes/auth_admin.php';
require_once __DIR__ . '/conexao.php';

$mensagem = '';
$tipoMensagem = 'success';
$editando = null;


/*
|--------------------------------------------------------------------------
| CREATE / UPDATE / DELETE
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acao = $_POST['acao'] ?? '';

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    if ($acao === 'excluir') {

        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0) {

            $stmt = $conn->prepare("
                DELETE FROM campeonatos
                WHERE id = ?
            ");

            $stmt->bind_param("i", $id);
            $stmt->execute();

            header('Location: admin_campeonatos.php?msg=excluido');
            exit;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE / UPDATE
    |--------------------------------------------------------------------------
    */

    if ($acao === 'salvar' || $acao === 'editar') {

        $id = (int) ($_POST['id'] ?? 0);

        $nome = trim($_POST['nome'] ?? '');
        $tipo = $_POST['tipo'] ?? '';

        $status = trim($_POST['status'] ?? '');
        $status = $status !== '' ? $status : null;

        $local = trim($_POST['local'] ?? '');
        $dataExibicao = trim($_POST['data_exibicao'] ?? '');

        $ano = trim($_POST['ano'] ?? '');
        $ano = $ano !== '' ? (int) $ano : null;

        $colocacao = trim($_POST['colocacao'] ?? '');
        $colocacao = $colocacao !== '' ? $colocacao : null;

        $icone = trim($_POST['icone'] ?? '');
        $icone = $icone !== '' ? $icone : null;

        $descricao = trim($_POST['descricao'] ?? '');
        $descricao = $descricao !== '' ? $descricao : null;


        /*
        |--------------------------------------------------------------------------
        | Validação básica
        |--------------------------------------------------------------------------
        */

        $tiposPermitidos = [
            'proximo',
            'disputado',
            'conquista'
        ];

        if (
            $nome === '' ||
            !in_array($tipo, $tiposPermitidos, true)
        ) {

            $mensagem = 'Preencha o nome e selecione um tipo válido.';
            $tipoMensagem = 'danger';

        } else {

            /*
            |--------------------------------------------------------------------------
            | CREATE
            |--------------------------------------------------------------------------
            */

            if ($acao === 'salvar') {

                $stmt = $conn->prepare("
                    INSERT INTO campeonatos (
                        nome,
                        tipo,
                        status,
                        local,
                        data_exibicao,
                        ano,
                        colocacao,
                        icone,
                        descricao
                    )
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");

                $stmt->bind_param(
                    "sssssisss",
                    $nome,
                    $tipo,
                    $status,
                    $local,
                    $dataExibicao,
                    $ano,
                    $colocacao,
                    $icone,
                    $descricao
                );

                $stmt->execute();

                header('Location: admin_campeonatos.php?msg=criado');
                exit;
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

            if ($acao === 'editar' && $id > 0) {

                $stmt = $conn->prepare("
                    UPDATE campeonatos
                    SET
                        nome = ?,
                        tipo = ?,
                        status = ?,
                        local = ?,
                        data_exibicao = ?,
                        ano = ?,
                        colocacao = ?,
                        icone = ?,
                        descricao = ?
                    WHERE id = ?
                ");

                $stmt->bind_param(
                    "sssssisssi",
                    $nome,
                    $tipo,
                    $status,
                    $local,
                    $dataExibicao,
                    $ano,
                    $colocacao,
                    $icone,
                    $descricao,
                    $id
                );

                $stmt->execute();

                header('Location: admin_campeonatos.php?msg=editado');
                exit;
            }
        }
    }
}


/*
|--------------------------------------------------------------------------
| EDITAR - busca registro
|--------------------------------------------------------------------------
*/

if (isset($_GET['edit'])) {

    $id = (int) $_GET['edit'];

    $stmt = $conn->prepare("
        SELECT *
        FROM campeonatos
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $editando = $stmt
        ->get_result()
        ->fetch_assoc();
}


/*
|--------------------------------------------------------------------------
| READ - todos os campeonatos
|--------------------------------------------------------------------------
*/

$resultado = $conn->query("
    SELECT *
    FROM campeonatos
    ORDER BY
        FIELD(
            tipo,
            'proximo',
            'disputado',
            'conquista'
        ),
        ano DESC,
        id DESC
");

$proximos = [];
$disputados = [];
$conquistas = [];

while ($camp = $resultado->fetch_assoc()) {

    if ($camp['tipo'] === 'proximo') {
        $proximos[] = $camp;
    }

    if ($camp['tipo'] === 'disputado') {
        $disputados[] = $camp;
    }

    if ($camp['tipo'] === 'conquista') {
        $conquistas[] = $camp;
    }
}


/*
|--------------------------------------------------------------------------
| Feedback
|--------------------------------------------------------------------------
*/

if (isset($_GET['msg'])) {

    switch ($_GET['msg']) {

        case 'criado':
            $mensagem = 'Campeonato criado com sucesso!';
            break;

        case 'editado':
            $mensagem = 'Campeonato atualizado com sucesso!';
            break;

        case 'excluido':
            $mensagem = 'Campeonato excluído com sucesso!';
            break;
    }
}


/*
|--------------------------------------------------------------------------
| Auxiliares
|--------------------------------------------------------------------------
*/

$statusLabels = [
    'aberto' => 'Inscrições abertas',
    'confirmado' => 'Confirmado',
    'analise' => 'Em análise',
    'finalizado' => 'Finalizado'
];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Campeonatos | StrikeSet Gaspar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<?php if ($editando): ?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const modalElement =
        document.getElementById('modalEditarCampeonato');

    const modal =
        new bootstrap.Modal(modalElement);

    modal.show();

});

</script>

<?php endif; ?>

<link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="visual/css/admin_campeonatos.css?v=<?php echo time(); ?>">

</head>

<body class="pagina-admin">

<?php require_once __DIR__ . '/includes/header_admin.php'; ?>

<?php if ($mensagem): ?>

    <div
        class="alert alert-<?= $tipoMensagem === 'danger' ? 'danger' : 'success' ?>"
        style="
            max-width:1200px;
            margin:20px auto;
        "
    >

        <?= htmlspecialchars($mensagem) ?>

    </div>

<?php endif; ?>

<section class="admin-hero">
    <div class="admin-hero-inner">

        <div class="admin-hero-texto">
            <span class="admin-hero-tag">Administração</span>

            <h1>Gerenciar Campeonatos</h1>

            <p>Adicione, edite e organize os campeonatos e resultados da equipe.</p>
        </div>

        <button
            class="btn-novo-campeonato"
            data-bs-toggle="modal"
            data-bs-target="#modalNovoCampeonato">

            + Novo Campeonato
        </button>

    </div>
</section>

<section class="admin-stats">
    <div class="stat-card">
    <strong>
        <?= count($proximos) + count($disputados) + count($conquistas) ?>
    </strong>

    <span>Campeonatos no total</span>
</div>


<div class="stat-card stat-card-destaque">

    <strong>
        <?= count($proximos) ?>
    </strong>

    <span>Próximos campeonatos</span>

</div>


<div class="stat-card">

    <strong>
        <?= count($disputados) ?>
    </strong>

    <span>Campeonatos disputados</span>

</div>


<div class="stat-card">

    <strong>
        <?= count($conquistas) ?>
    </strong>

    <span>Conquistas</span>

</div>
</section>

<section class="admin-conteudo">
    <div class="admin-inner">

        <div class="admin-filtros">

            <input
                id="buscarCampeonato"
                class="filtro-busca"
                type="text"
                placeholder="Buscar campeonato..."
            >

            <div class="filtro-selects">

                <select id="filtroTipo" class="filtro-select">
                    <option value="">Todos</option>
                    <option value="proximos">Próximos</option>
                    <option value="disputados">Disputados</option>
                    <option value="conquistas">Conquistas</option>
                </select>

                <select id="filtroStatus" class="filtro-select">
                    <option value="">Todos os status</option>
                    <option value="aberto">Inscrições abertas</option>
                    <option value="confirmado">Confirmado</option>
                    <option value="analise">Em análise</option>
                </select>

            </div>
        </div>

        <div class="admin-secao">

            <div class="admin-secao-topo">
                <div class="admin-secao-titulo">
                    <span class="barra"></span>
                    <h2>Próximos campeonatos</h2>
                </div>
                <span class="admin-secao-contagem">
               <?= count($proximos) ?> cadastrados
               </span>
            </div>

            <div class="admin-grid">

    <?php if (empty($proximos)): ?>

        <p>Nenhum campeonato futuro cadastrado.</p>

    <?php else: ?>

        <?php foreach ($proximos as $camp): ?>

            <div class="camp-admin-card">

                <div class="camp-card-topo">

                    <?php if ($camp['status']): ?>

                        <span
                            class="camp-status status-<?= htmlspecialchars($camp['status']) ?>"
                        >
                            <?= htmlspecialchars(
                                $statusLabels[$camp['status']]
                                ?? $camp['status']
                            ) ?>
                        </span>

                    <?php endif; ?>

                </div>


                <h3>
                    <?= htmlspecialchars($camp['nome']) ?>
                </h3>


                <div class="camp-card-info">

                    <div class="camp-info-item">

                        <span class="info-label">
                            Local
                        </span>

                        <span class="info-val">
                            <?= htmlspecialchars($camp['local'] ?: '-') ?>
                        </span>

                    </div>


                    <div class="camp-info-item">

                        <span class="info-label">
                            Data
                        </span>

                        <span class="info-val">
                            <?= htmlspecialchars($camp['data_exibicao'] ?: '-') ?>
                        </span>

                    </div>

                </div>


                <div class="admin-card-acoes">

                    <a
                        href="admin_campeonatos.php?edit=<?= $camp['id'] ?>"
                        class="acao-btn acao-editar"
                    >
                        Editar
                    </a>


                    <form
                        method="POST"
                        onsubmit="return confirm('Excluir este campeonato?');"
                    >

                        <input
                            type="hidden"
                            name="acao"
                            value="excluir"
                        >

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $camp['id'] ?>"
                        >

                        <button
                            type="submit"
                            class="acao-btn acao-excluir"
                        >
                            Excluir
                        </button>

                    </form>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

                

        <div class="admin-secao">

            <div class="admin-secao-topo">
                <div class="admin-secao-titulo">
                    <span class="barra"></span>
                    <h2>Campeonatos disputados</h2>
                </div>
                <span class="admin-secao-contagem">
              <?= count($disputados) ?> cadastrados
               </span>
            </div>

            <div class="disputados-lista">

    <?php if (empty($disputados)): ?>

        <p>Nenhum campeonato disputado cadastrado.</p>

    <?php else: ?>

        <?php foreach ($disputados as $camp): ?>

            <div class="disp-admin-card">

                <div class="disp-ano">
                    <?= htmlspecialchars($camp['ano'] ?: '-') ?>
                </div>

                <div class="disp-corpo">

                    <div class="disp-info">

                        <h3>
                            <?= htmlspecialchars($camp['nome']) ?>
                        </h3>

                        <?php if ($camp['colocacao']): ?>

                            <span class="disp-coloc">
                                <?= htmlspecialchars($camp['colocacao']) ?>
                            </span>

                        <?php endif; ?>

                    </div>


                    <div class="disp-acoes">

                        <a
                            href="admin_campeonatos.php?edit=<?= $camp['id'] ?>"
                            class="acao-btn acao-editar"
                        >
                            Editar
                        </a>


                        <form
                            method="POST"
                            onsubmit="return confirm('Excluir este campeonato?');"
                        >

                            <input
                                type="hidden"
                                name="acao"
                                value="excluir"
                            >

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $camp['id'] ?>"
                            >

                            <button
                                type="submit"
                                class="acao-btn acao-excluir"
                            >
                                Excluir
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>
        <div class="admin-secao">

            <div class="admin-secao-topo">
                <div class="admin-secao-titulo">
                    <span class="admin-secao-contagem">
                   <?= count($conquistas) ?> cadastradas
                  </span>
            </div>

            <div class="conquistas-grid">

    <?php if (empty($conquistas)): ?>

        <p>Nenhuma conquista cadastrada.</p>

    <?php else: ?>

        <?php foreach ($conquistas as $camp): ?>

            <div class="conq-admin-card">

                <div class="conq-icone">
                    <?= htmlspecialchars($camp['icone'] ?: '🏆') ?>
                </div>

                <h4>
                    <?= htmlspecialchars($camp['nome']) ?>
                </h4>

                <p>
                    <?= htmlspecialchars(
                        $camp['descricao']
                        ?: $camp['data_exibicao']
                        ?: ''
                    ) ?>
                </p>


                <div class="admin-card-acoes">

                    <a
                        href="admin_campeonatos.php?edit=<?= $camp['id'] ?>"
                        class="acao-btn acao-editar"
                    >
                        Editar
                    </a>


                    <form
                        method="POST"
                        onsubmit="return confirm('Excluir esta conquista?');"
                    >

                        <input
                            type="hidden"
                            name="acao"
                            value="excluir"
                        >

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $camp['id'] ?>"
                        >

                        <button
                            type="submit"
                            class="acao-btn acao-excluir"
                        >
                            Excluir
                        </button>

                    </form>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

        <div class="modal fade" id="modalNovoCampeonato" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form
            method="POST"
            action="admin_campeonatos.php"
            class="modal-content admin-modal-content"
        >

            <input
                type="hidden"
                name="acao"
                value="salvar"
            >

            <div class="modal-header admin-modal-header">

                <h5 class="modal-title">
                    Novo Campeonato
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body admin-modal-body">

                <div class="admin-form">

                    <div class="form-grupo form-grupo-full">

                        <label>
                            Nome do campeonato
                        </label>

                        <input
                            type="text"
                            name="nome"
                            placeholder="Ex: Copa Regional de Vôlei"
                            required
                        >

                    </div>


                    <div class="form-grupo">

                        <label>Tipo</label>

                        <select name="tipo" required>

                            <option value="">
                                Selecione o tipo
                            </option>

                            <option value="proximo">
                                Próximo campeonato
                            </option>

                            <option value="disputado">
                                Campeonato disputado
                            </option>

                            <option value="conquista">
                                Conquista
                            </option>

                        </select>

                    </div>


                    <div class="form-grupo">

                        <label>Status</label>

                        <select name="status">

                            <option value="">
                                Sem status
                            </option>

                            <option value="aberto">
                                Inscrições abertas
                            </option>

                            <option value="confirmado">
                                Confirmado
                            </option>

                            <option value="analise">
                                Em análise
                            </option>

                            <option value="finalizado">
                                Finalizado
                            </option>

                        </select>

                    </div>


                    <div class="form-grupo">

                        <label>Local</label>

                        <input
                            type="text"
                            name="local"
                            placeholder="Ex: Ginásio IFSC Gaspar"
                        >

                    </div>


                    <div class="form-grupo">

                        <label>Data</label>

                        <input
                            type="text"
                            name="data_exibicao"
                            placeholder="Ex: 14 e 15 de junho de 2026"
                        >

                    </div>


                    <div class="form-grupo">

                        <label>Ano</label>

                        <input
                            type="number"
                            name="ano"
                            placeholder="Ex: 2026"
                        >

                    </div>


                    <div class="form-grupo">

                        <label>Colocação</label>

                        <select name="colocacao">

                            <option value="">
                                Não informado
                            </option>

                            <option value="1º lugar">
                                1º lugar
                            </option>

                            <option value="2º lugar">
                                2º lugar
                            </option>

                            <option value="3º lugar">
                                3º lugar
                            </option>

                            <option value="4º lugar">
                                4º lugar
                            </option>

                            <option value="Participação">
                                Participação
                            </option>

                        </select>

                    </div>


                    <div class="form-grupo">

                        <label>
                            Ícone da conquista
                            <span class="opcional">
                                (opcional)
                            </span>
                        </label>

                        <input
                            type="text"
                            name="icone"
                            placeholder="Ex: 🥇"
                        >

                    </div>


                    <div class="form-grupo form-grupo-full">

                        <label>Descrição</label>

                        <textarea
                            name="descricao"
                            rows="3"
                            placeholder="Descrição curta do campeonato..."
                        ></textarea>

                    </div>

                </div>

            </div>


            <div class="modal-footer admin-modal-footer">

                <button
                    type="button"
                    class="btn-modal-cancelar"
                    data-bs-dismiss="modal"
                >
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="btn-modal-salvar"
                >
                    Salvar campeonato
                </button>

            </div>

        </form>

    </div>

</div>
        </div>

        <?php if ($editando): ?>

<div class="modal fade" id="modalEditarCampeonato" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form
            method="POST"
            action="admin_campeonatos.php"
            class="modal-content admin-modal-content"
        >

            <input
                type="hidden"
                name="acao"
                value="editar"
            >

            <input
                type="hidden"
                name="id"
                value="<?= (int) $editando['id'] ?>"
            >

            <div class="modal-header admin-modal-header">

                <h5 class="modal-title">
                    Editar Campeonato
                </h5>

                <a
                    href="admin_campeonatos.php"
                    class="btn-close btn-close-white"
                ></a>

            </div>

            <div class="modal-body admin-modal-body">

                <div class="admin-form">

                    <div class="form-grupo form-grupo-full">

                        <label>Nome do campeonato</label>

                        <input
                            type="text"
                            name="nome"
                            value="<?= htmlspecialchars($editando['nome'] ?? '') ?>"
                            required
                        >

                    </div>

                    <div class="form-grupo">

                        <label>Tipo</label>

                        <select name="tipo" required>

                            <option value="proximo"
                                <?= ($editando['tipo'] ?? '') === 'proximo' ? 'selected' : '' ?>>
                                Próximo campeonato
                            </option>

                            <option value="disputado"
                                <?= ($editando['tipo'] ?? '') === 'disputado' ? 'selected' : '' ?>>
                                Campeonato disputado
                            </option>

                            <option value="conquista"
                                <?= ($editando['tipo'] ?? '') === 'conquista' ? 'selected' : '' ?>>
                                Conquista
                            </option>

                        </select>

                    </div>

                    <div class="form-grupo">

                        <label>Status</label>

                        <select name="status">

                            <option value="">
                                Sem status
                            </option>

                            <option value="aberto"
                                <?= ($editando['status'] ?? '') === 'aberto' ? 'selected' : '' ?>>
                                Inscrições abertas
                            </option>

                            <option value="confirmado"
                                <?= ($editando['status'] ?? '') === 'confirmado' ? 'selected' : '' ?>>
                                Confirmado
                            </option>

                            <option value="analise"
                                <?= ($editando['status'] ?? '') === 'analise' ? 'selected' : '' ?>>
                                Em análise
                            </option>

                            <option value="finalizado"
                                <?= ($editando['status'] ?? '') === 'finalizado' ? 'selected' : '' ?>>
                                Finalizado
                            </option>

                        </select>

                    </div>

                    <div class="form-grupo">

                        <label>Local</label>

                        <input
                            type="text"
                            name="local"
                            value="<?= htmlspecialchars($editando['local'] ?? '') ?>"
                        >

                    </div>

                    <div class="form-grupo">

                        <label>Data</label>

                        <input
                            type="text"
                            name="data_exibicao"
                            value="<?= htmlspecialchars($editando['data_exibicao'] ?? '') ?>"
                        >

                    </div>

                    <div class="form-grupo">

                        <label>Ano</label>

                        <input
                            type="number"
                            name="ano"
                            value="<?= htmlspecialchars($editando['ano'] ?? '') ?>"
                        >

                    </div>

                    <div class="form-grupo">

                        <label>Colocação</label>

                        <select name="colocacao">

                            <option value="">
                                Não informado
                            </option>

                            <option value="1º lugar"
                                <?= ($editando['colocacao'] ?? '') === '1º lugar' ? 'selected' : '' ?>>
                                1º lugar
                            </option>

                            <option value="2º lugar"
                                <?= ($editando['colocacao'] ?? '') === '2º lugar' ? 'selected' : '' ?>>
                                2º lugar
                            </option>

                            <option value="3º lugar"
                                <?= ($editando['colocacao'] ?? '') === '3º lugar' ? 'selected' : '' ?>>
                                3º lugar
                            </option>

                            <option value="4º lugar"
                                <?= ($editando['colocacao'] ?? '') === '4º lugar' ? 'selected' : '' ?>>
                                4º lugar
                            </option>

                            <option value="Participação"
                                <?= ($editando['colocacao'] ?? '') === 'Participação' ? 'selected' : '' ?>>
                                Participação
                            </option>

                        </select>

                    </div>

                    <div class="form-grupo">

                        <label>
                            Ícone da conquista
                            <span class="opcional">(opcional)</span>
                        </label>

                        <input
                            type="text"
                            name="icone"
                            value="<?= htmlspecialchars($editando['icone'] ?? '') ?>"
                            placeholder="Ex: 🥇"
                        >

                    </div>

                    <div class="form-grupo form-grupo-full">

                        <label>Descrição</label>

                        <textarea
                            name="descricao"
                            rows="3"
                        ><?= htmlspecialchars($editando['descricao'] ?? '') ?></textarea>

                    </div>

                </div>

            </div>

            <div class="modal-footer admin-modal-footer">

                <a
                    href="admin_campeonatos.php"
                    class="btn-modal-cancelar"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn-modal-salvar"
                >
                    Salvar alterações
                </button>

            </div>

        </form>

    </div>

</div>

<?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>