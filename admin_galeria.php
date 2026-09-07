<?php

require_once __DIR__ . '/includes/auth_admin.php';
require_once __DIR__ . '/conexao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Galeria | StrikeSet Gaspar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="visual/css/admin_galeria.css?v=<?php echo time(); ?>">

</head>

<body class="pagina-admin">

<?php require_once __DIR__ . '/includes/header_admin.php'; ?>

<section class="admin-hero">
    <div class="admin-hero-inner">

        <div class="admin-hero-texto">
            <span class="admin-hero-tag">Administração</span>

            <h1>Gerenciar Galeria</h1>

            <p>Adicione, edite e organize os álbuns da equipe.</p>
        </div>

        <button
            class="btn-novo-album"
            data-bs-toggle="modal"
            data-bs-target="#modalNovoAlbum">

            + Novo Album
        </button>

    </div>
</section>

<section class="admin-stats">
    <div class="admin-inner">

        <div class="stats-grid">

            <div class="stat-card">
                <strong>6</strong>
                <span>Albums no total</span>
            </div>

            <div class="stat-card">
                <strong>48</strong>
                <span>Fotos cadastradas</span>
            </div>

            <div class="stat-card stat-card-destaque">
                <strong>4</strong>
                <span>Albums publicados</span>
            </div>

            <div class="stat-card">
                <strong>2</strong>
                <span>Albums ocultos</span>
            </div>

        </div>
    </div>
</section>

<section class="admin-conteudo">

    <div class="admin-inner">

        <!-- FILTROS -->
        <div class="admin-filtros">

            <input
                id="buscarAlbum"
                class="filtro-busca"
                type="text"
                placeholder="Buscar album..."
            >

            <div class="filtro-selects">

                <select id="filtroCategoria" class="filtro-select">
                    <option value="">Todas as categorias</option>
                    <option value="treinos">Treinos</option>
                    <option value="campeonatos">Campeonatos</option>
                    <option value="time">Time</option>
                    <option value="bastidores">Bastidores</option>
                </select>

                <select id="filtroStatus" class="filtro-select">
                    <option value="">Todos os status</option>
                    <option value="publicado">Publicado</option>
                    <option value="oculto">Oculto</option>
                </select>

            </div>
        </div>

<div class="admin-grid">

    <!-- TREINOS -->
    <div class="admin-card"
         data-categoria="treinos"
         data-status="publicado">

        <div class="admin-card-img">
            <img src="visual/images/treino1.avif" alt="Treinos">

            <span class="album-status status-pub">
                Publicado
            </span>
        </div>

        <div class="admin-card-corpo">

            <div class="admin-card-info">

                <h4>Treinos</h4>

                <div class="admin-card-meta">
                    <span>2 fotos</span>
                    <span>10 Jan 2026</span>
                </div>

                <p class="admin-card-categoria">
                    Treinos
                </p>

                <p class="admin-card-desc">
                    Preparação da equipe para campeonatos.
                </p>

            </div>

            <div class="admin-card-acoes">

                <button
                    class="acao-btn acao-ver"
                    onclick="window.location.href='galeria.php'">
                    Ver
                </button>

                <button
                    class="acao-btn acao-editar"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditarAlbum">
                    Editar
                </button>

                <button class="acao-btn acao-excluir">
                    Excluir
                </button>

            </div>

        </div>
    </div>

    <!-- CAMPEONATO -->
    <div class="admin-card"
         data-categoria="campeonatos"
         data-status="publicado">

        <div class="admin-card-img">
            <img src="visual/images/camp1.avif" alt="Campeonato Regional">

            <span class="album-status status-pub">
                Publicado
            </span>
        </div>

        <div class="admin-card-corpo">

            <div class="admin-card-info">

                <h4>Campeonato Regional</h4>

                <div class="admin-card-meta">
                    <span>2 fotos</span>
                    <span>22 Fev 2026</span>
                </div>

                <p class="admin-card-categoria">
                    Campeonatos
                </p>

                <p class="admin-card-desc">
                    Fotos da participação no regional.
                </p>

            </div>

            <div class="admin-card-acoes">

                <button
                    class="acao-btn acao-ver"
                    onclick="window.location.href='galeria.php'">
                    Ver
                </button>

                <button
                    class="acao-btn acao-editar"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditarAlbum">
                    Editar
                </button>

                <button class="acao-btn acao-excluir">
                    Excluir
                </button>

            </div>

        </div>
    </div>

    <!-- TIME -->
    <div class="admin-card"
         data-categoria="time"
         data-status="publicado">

        <div class="admin-card-img">
            <img src="visual/images/time1.avif" alt="Time 2026">

            <span class="album-status status-pub">
                Publicado
            </span>
        </div>

        <div class="admin-card-corpo">

            <div class="admin-card-info">

                <h4>Time 2026</h4>

                <div class="admin-card-meta">
                    <span>2 fotos</span>
                    <span>30 Mar 2026</span>
                </div>

                <p class="admin-card-categoria">
                    Time
                </p>

                <p class="admin-card-desc">
                    Fotos oficiais do elenco 2026.
                </p>

            </div>

            <div class="admin-card-acoes">

                <button
                    class="acao-btn acao-ver"
                    onclick="window.location.href='galeria.php'">
                    Ver
                </button>

                <button
                    class="acao-btn acao-editar"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditarAlbum">
                    Editar
                </button>

                <button class="acao-btn acao-excluir">
                    Excluir
                </button>

            </div>

        </div>
    </div>

    <!-- OCULTO -->
    <div class="admin-card"
         data-categoria="bastidores"
         data-status="oculto">

        <div class="admin-card-corpo">

            <div class="admin-card-info">

                <h4>Bastidores</h4>

                <div class="admin-card-meta">
                    <span>0 fotos</span>
                    <span>Oculto</span>
                </div>

                <p class="admin-card-categoria">
                    Bastidores
                </p>

                <p class="admin-card-desc">
                    Album ainda não publicado.
                </p>

            </div>

            <div class="admin-card-acoes">

                <button
                    class="acao-btn acao-editar"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditarAlbum">
                    Editar
                </button>

                <button class="acao-btn acao-excluir">
                    Excluir
                </button>

            </div>

        </div>
    </div>

</div>

<!-- MODAL NOVO -->
<div class="modal fade" id="modalNovoAlbum" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content admin-modal-content">

            <div class="modal-header admin-modal-header">

                <h5 class="modal-title">
                    Novo Album
                </h5>

                <button
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body admin-modal-body">

                <div class="admin-form">

                    <div class="form-grupo">
                        <label>Nome do album</label>
                        <input type="text" placeholder="Ex: Treinos Maio 2026">
                    </div>

                    <div class="form-grupo">
                        <label>Categoria</label>

                        <select>
                            <option value="">Selecione uma categoria</option>
                            <option>Treinos</option>
                            <option>Campeonatos</option>
                            <option>Time</option>
                            <option>Bastidores</option>
                        </select>
                    </div>

                    <div class="form-grupo">
                        <label>Imagem de capa</label>
                        <input type="file" accept="image/*">
                    </div>

                    <div class="form-grupo">
                        <label>Descricao</label>

                        <textarea rows="3"
                            placeholder="Descricao curta do album...">
                        </textarea>
                    </div>

                    <div class="form-grupo">

                        <label>Status</label>

                        <select>
                            <option value="publicado">Publicado</option>
                            <option value="oculto">Oculto</option>
                        </select>

                    </div>

                </div>

            </div>

            <div class="modal-footer admin-modal-footer">

                <button
                    class="btn-modal-cancelar"
                    data-bs-dismiss="modal">

                    Cancelar
                </button>

                <button class="btn-modal-salvar">
                    Salvar album
                </button>

            </div>

        </div>

    </div>
</div>

<!-- MODAL EDITAR -->
<div class="modal fade" id="modalEditarAlbum" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content admin-modal-content">

            <div class="modal-header admin-modal-header">

                <h5 class="modal-title">
                    Editar Album
                </h5>

                <button
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body admin-modal-body">

                <div class="admin-form">

                    <div class="form-grupo">
                        <label>Nome do album</label>
                        <input type="text" value="Treinos">
                    </div>

                    <div class="form-grupo">

                        <label>Categoria</label>

                        <select>
                            <option selected>Treinos</option>
                            <option>Campeonatos</option>
                            <option>Time</option>
                            <option>Bastidores</option>
                        </select>

                    </div>

                    <div class="form-grupo">

                        <label>Descricao</label>

                        <textarea rows="3">
Preparação da equipe para o campeonato regional.
                        </textarea>

                    </div>

                    <div class="form-grupo">

                        <label>Status</label>

                        <select>
                            <option value="publicado" selected>
                                Publicado
                            </option>

                            <option value="oculto">
                                Oculto
                            </option>
                        </select>

                    </div>

                    <!-- NOVO -->
                    <div class="form-grupo">

                        <label>Adicionar fotos</label>

                        <input
                            type="file"
                            accept="image/*"
                            multiple>

                        <small class="texto-upload">
                            Você pode selecionar várias fotos.
                        </small>

                    </div>

                </div>

            </div>

            <div class="modal-footer admin-modal-footer">

                <button
                    class="btn-modal-cancelar"
                    data-bs-dismiss="modal">

                    Cancelar
                </button>

                <button class="btn-modal-salvar">
                    Salvar alteracoes
                </button>

            </div>

        </div>

    </div>
</div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {

    console.log('DOM carregado!');

    const botoesExcluir = document.querySelectorAll('.acao-excluir');

    console.log('Botões excluir:', botoesExcluir.length);

    botoesExcluir.forEach((btn) => {

        btn.addEventListener('click', function() {

            const confirmar = confirm(
                'Deseja realmente excluir este álbum?'
            );

            if(confirmar) {

                const card = btn.closest('.admin-card');

                card.remove();

                alert('Álbum excluído com sucesso!');

            }

        });

    });
    const botoesEditar = document.querySelectorAll('.acao-editar');

    console.log('Botões editar:', botoesEditar.length);

    botoesEditar.forEach((btn) => {

        btn.addEventListener('click', function() {

            console.log('Abrindo modal de edição');

        });

    });
    const btnSalvarNovo = document.querySelector(
        '#modalNovoAlbum .btn-modal-salvar'
    );

    if(btnSalvarNovo) {

        btnSalvarNovo.addEventListener('click', function() {

            alert('Novo álbum salvo!');

            const modal = bootstrap.Modal.getInstance(
                document.getElementById('modalNovoAlbum')
            );

            modal.hide();

        });

    }
    const btnSalvarEdicao = document.querySelector(
        '#modalEditarAlbum .btn-modal-salvar'
    );

    if(btnSalvarEdicao) {

        btnSalvarEdicao.addEventListener('click', function() {

            alert('Alterações salvas!');

            const modal = bootstrap.Modal.getInstance(
                document.getElementById('modalEditarAlbum')
            );

            modal.hide();

        });

    }
    const botoesVer = document.querySelectorAll('.acao-ver');

    botoesVer.forEach((btn) => {

        btn.addEventListener('click', function() {

            alert('Abrindo galeria...');

        });

    });

});

</script>

</body>
</html>
