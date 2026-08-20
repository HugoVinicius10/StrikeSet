<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Campeonatos | StrikeSet Gaspar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="global.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="admin_campeonatos.css?v=<?php echo time(); ?>">

</head>

<body class="pagina-admin">

<header>
    <h2>StrikeSet Gaspar</h2>

    <nav>
        <a href="home.php">Inicio</a>
        <a href="admin_galeria.php">Galeria</a>
        <a href="sobre.php">Sobre</a>
        <a href="admin_treinos.php">Treinos</a>
        <a href="admin_campeonatos.php" class="active">Campeonatos</a>

        <span class="admin-badge">PAINEL ADMIN</span>

    </nav>
</header>

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
    <div class="admin-inner">

        <div class="stats-grid">

            <div class="stat-card">
                <strong>8</strong>
                <span>Campeonatos no total</span>
            </div>

            <div class="stat-card stat-card-destaque">
                <strong>3</strong>
                <span>Próximos campeonatos</span>
            </div>

            <div class="stat-card">
                <strong>5</strong>
                <span>Campeonatos disputados</span>
            </div>

            <div class="stat-card">
                <strong>6</strong>
                <span>Conquistas</span>
            </div>

        </div>
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
                <span class="admin-secao-contagem">4 cadastrados</span>
            </div>

            <div class="admin-grid">

                <div class="camp-admin-card">

                    <div class="camp-card-topo">
                        <span class="camp-status status-aberto">Inscrições abertas</span>
                    </div>

                    <h3>Campeonato IFSC</h3>

                    <div class="camp-card-info">
                        <div class="camp-info-item">
                            <span class="info-label">Local</span>
                            <span class="info-val">Ginásio IFSC Gaspar</span>
                        </div>
                        <div class="camp-info-item">
                            <span class="info-label">Data</span>
                            <span class="info-val">14 e 15 de junho de 2026</span>
                        </div>
                    </div>

                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>

                        <button class="acao-btn acao-excluir">
                            Excluir
                        </button>
                    </div>

                </div>

                <div class="camp-admin-card">

                    <div class="camp-card-topo">
                        <span class="camp-status status-confirmado">Confirmado</span>
                    </div>

                    <h3>Torneio Regional Universitário</h3>

                    <div class="camp-card-info">
                        <div class="camp-info-item">
                            <span class="info-label">Local</span>
                            <span class="info-val">Arena Blumenau</span>
                        </div>
                        <div class="camp-info-item">
                            <span class="info-label">Data</span>
                            <span class="info-val">5 de julho de 2026</span>
                        </div>
                    </div>

                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>

                        <button class="acao-btn acao-excluir">
                            Excluir
                        </button>
                    </div>

                </div>

                <div class="camp-admin-card">

                    <div class="camp-card-topo">
                        <span class="camp-status status-analise">Em análise</span>
                    </div>

                    <h3>Jogos da Integração SC</h3>

                    <div class="camp-card-info">
                        <div class="camp-info-item">
                            <span class="info-label">Local</span>
                            <span class="info-val">Florianópolis</span>
                        </div>
                        <div class="camp-info-item">
                            <span class="info-label">Data</span>
                            <span class="info-val">Setembro de 2026</span>
                        </div>
                    </div>

                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>

                        <button class="acao-btn acao-excluir">
                            Excluir
                        </button>
                    </div>

                </div>

                <div class="camp-admin-card">

                    <div class="camp-card-topo">
                        <span class="camp-status status-aberto">Inscrições abertas</span>
                    </div>

                    <h3>Copa Universitária de Vôlei</h3>

                    <div class="camp-card-info">
                        <div class="camp-info-item">
                            <span class="info-label">Local</span>
                            <span class="info-val">Ginásio Central de Blumenau</span>
                        </div>
                        <div class="camp-info-item">
                            <span class="info-label">Data</span>
                            <span class="info-val">20 de agosto de 2026</span>
                        </div>
                    </div>

                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>

                        <button class="acao-btn acao-excluir">
                            Excluir
                        </button>
                    </div>

                </div>

            </div>
        </div>

        <div class="admin-secao">

            <div class="admin-secao-topo">
                <div class="admin-secao-titulo">
                    <span class="barra"></span>
                    <h2>Campeonatos disputados</h2>
                </div>
                <span class="admin-secao-contagem">5 cadastrados</span>
            </div>

            <div class="disputados-lista">

                <div class="disp-admin-card">
                    <div class="disp-ano">2026</div>
                    <div class="disp-corpo">
                        <div class="disp-info">
                            <h3>Copa IFSC de Vôlei</h3>
                            <span class="disp-coloc coloc-prata">2º lugar</span>
                        </div>
                        <div class="disp-acoes">
                            <button
                                class="acao-btn acao-editar"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarCampeonato">
                                Editar
                            </button>
                            <button class="acao-btn acao-excluir">Excluir</button>
                        </div>
                    </div>
                </div>

                <div class="disp-admin-card">
                    <div class="disp-ano">2025</div>
                    <div class="disp-corpo">
                        <div class="disp-info">
                            <h3>Torneio Integração IFSC</h3>
                            <span class="disp-coloc coloc-ouro">1º lugar</span>
                        </div>
                        <div class="disp-acoes">
                            <button
                                class="acao-btn acao-editar"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarCampeonato">
                                Editar
                            </button>
                            <button class="acao-btn acao-excluir">Excluir</button>
                        </div>
                    </div>
                </div>

                <div class="disp-admin-card">
                    <div class="disp-ano">2025</div>
                    <div class="disp-corpo">
                        <div class="disp-info">
                            <h3>Regional Universitário SC</h3>
                            <span class="disp-coloc coloc-bronze">3º lugar</span>
                        </div>
                        <div class="disp-acoes">
                            <button
                                class="acao-btn acao-editar"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarCampeonato">
                                Editar
                            </button>
                            <button class="acao-btn acao-excluir">Excluir</button>
                        </div>
                    </div>
                </div>

                <div class="disp-admin-card">
                    <div class="disp-ano">2025</div>
                    <div class="disp-corpo">
                        <div class="disp-info">
                            <h3>Copa Gaspar de Vôlei</h3>
                            <span class="disp-coloc coloc-prata">2º lugar</span>
                        </div>
                        <div class="disp-acoes">
                            <button
                                class="acao-btn acao-editar"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarCampeonato">
                                Editar
                            </button>
                            <button class="acao-btn acao-excluir">Excluir</button>
                        </div>
                    </div>
                </div>

                <div class="disp-admin-card">
                    <div class="disp-ano">2024</div>
                    <div class="disp-corpo">
                        <div class="disp-info">
                            <h3>Torneio Amistoso Vale do Itajaí</h3>
                            <span class="disp-coloc coloc-neutro">4º lugar</span>
                        </div>
                        <div class="disp-acoes">
                            <button
                                class="acao-btn acao-editar"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarCampeonato">
                                Editar
                            </button>
                            <button class="acao-btn acao-excluir">Excluir</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="admin-secao">

            <div class="admin-secao-topo">
                <div class="admin-secao-titulo">
                    <span class="barra"></span>
                    <h2>Conquistas</h2>
                </div>
                <span class="admin-secao-contagem">6 cadastradas</span>
            </div>

            <div class="conquistas-grid">

                <div class="conq-admin-card">
                    <div class="conq-icone">🥈</div>
                    <h4>Vice-campeão regional</h4>
                    <p>Copa IFSC 2026</p>
                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>
                        <button class="acao-btn acao-excluir">Excluir</button>
                    </div>
                </div>

                <div class="conq-admin-card">
                    <div class="conq-icone">🥇</div>
                    <h4>Campeão integração IFSC</h4>
                    <p>Torneio IFSC 2025</p>
                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>
                        <button class="acao-btn acao-excluir">Excluir</button>
                    </div>
                </div>

                <div class="conq-admin-card">
                    <div class="conq-icone">🛡️</div>
                    <h4>Melhor defesa</h4>
                    <p>Regional SC 2025</p>
                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>
                        <button class="acao-btn acao-excluir">Excluir</button>
                    </div>
                </div>

                <div class="conq-admin-card">
                    <div class="conq-icone">🏐</div>
                    <h4>Destaque universitário</h4>
                    <p>Copa Gaspar 2025</p>
                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>
                        <button class="acao-btn acao-excluir">Excluir</button>
                    </div>
                </div>

                <div class="conq-admin-card">
                    <div class="conq-icone">💥</div>
                    <h4>Melhor saque</h4>
                    <p>Torneio Integração 2025</p>
                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>
                        <button class="acao-btn acao-excluir">Excluir</button>
                    </div>
                </div>

                <div class="conq-admin-card">
                    <div class="conq-icone">📈</div>
                    <h4>Maior evolução</h4>
                    <p>Avaliação interna 2024</p>
                    <div class="admin-card-acoes">
                        <button
                            class="acao-btn acao-editar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarCampeonato">
                            Editar
                        </button>
                        <button class="acao-btn acao-excluir">Excluir</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modalNovoCampeonato" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content admin-modal-content">

                    <div class="modal-header admin-modal-header">
                        <h5 class="modal-title">Novo Campeonato</h5>
                        <button
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body admin-modal-body">
                        <div class="admin-form">

                            <div class="form-grupo form-grupo-full">
                                <label>Nome do campeonato</label>
                                <input type="text" placeholder="Ex: Copa Regional de Vôlei">
                            </div>

                            <div class="form-grupo">
                                <label>Tipo</label>
                                <select>
                                    <option value="">Selecione o tipo</option>
                                    <option value="proximo">Próximo campeonato</option>
                                    <option value="disputado">Campeonato disputado</option>
                                    <option value="conquista">Conquista</option>
                                </select>
                            </div>

                            <div class="form-grupo">
                                <label>Status</label>
                                <select>
                                    <option value="">Selecione o status</option>
                                    <option value="aberto">Inscrições abertas</option>
                                    <option value="confirmado">Confirmado</option>
                                    <option value="analise">Em análise</option>
                                    <option value="finalizado">Finalizado</option>
                                </select>
                            </div>

                            <div class="form-grupo">
                                <label>Local</label>
                                <input type="text" placeholder="Ex: Ginásio IFSC Gaspar">
                            </div>

                            <div class="form-grupo">
                                <label>Data</label>
                                <input type="text" placeholder="Ex: 14 e 15 de junho de 2026">
                            </div>

                            <div class="form-grupo">
                                <label>Ano</label>
                                <input type="text" placeholder="Ex: 2026">
                            </div>

                            <div class="form-grupo">
                                <label>Colocação</label>
                                <select>
                                    <option value="">Selecione a colocação</option>
                                    <option value="1">1º lugar</option>
                                    <option value="2">2º lugar</option>
                                    <option value="3">3º lugar</option>
                                    <option value="4">4º lugar</option>
                                    <option value="participacao">Participação</option>
                                    <option value="nao-informado">Não informado</option>
                                </select>
                            </div>

                            <div class="form-grupo">
                                <label>Ícone da conquista <span class="opcional">(opcional)</span></label>
                                <input type="text" placeholder="Ex: 🥇">
                            </div>

                            <div class="form-grupo form-grupo-full">
                                <label>Descrição</label>
                                <textarea rows="3" placeholder="Descrição curta do campeonato..."></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer admin-modal-footer">
                        <button class="btn-modal-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn-modal-salvar">Salvar campeonato</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditarCampeonato" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content admin-modal-content">

                    <div class="modal-header admin-modal-header">
                        <h5 class="modal-title">Editar Campeonato</h5>
                        <button
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body admin-modal-body">
                        <div class="admin-form">

                            <div class="form-grupo form-grupo-full">
                                <label>Nome do campeonato</label>
                                <input type="text" value="Campeonato IFSC">
                            </div>

                            <div class="form-grupo">
                                <label>Tipo</label>
                                <select>
                                    <option value="proximo" selected>Próximo campeonato</option>
                                    <option value="disputado">Campeonato disputado</option>
                                    <option value="conquista">Conquista</option>
                                </select>
                            </div>

                            <div class="form-grupo">
                                <label>Status</label>
                                <select>
                                    <option value="aberto" selected>Inscrições abertas</option>
                                    <option value="confirmado">Confirmado</option>
                                    <option value="analise">Em análise</option>
                                    <option value="finalizado">Finalizado</option>
                                </select>
                            </div>

                            <div class="form-grupo">
                                <label>Local</label>
                                <input type="text" value="Ginásio IFSC Gaspar">
                            </div>

                            <div class="form-grupo">
                                <label>Data</label>
                                <input type="text" value="14 e 15 de junho de 2026">
                            </div>

                            <div class="form-grupo">
                                <label>Ano</label>
                                <input type="text" value="2026">
                            </div>

                            <div class="form-grupo">
                                <label>Colocação</label>
                                <select>
                                    <option value="">Selecione a colocação</option>
                                    <option value="1">1º lugar</option>
                                    <option value="2">2º lugar</option>
                                    <option value="3">3º lugar</option>
                                    <option value="4">4º lugar</option>
                                    <option value="participacao">Participação</option>
                                    <option value="nao-informado" selected>Não informado</option>
                                </select>
                            </div>

                            <div class="form-grupo">
                                <label>Ícone da conquista <span class="opcional">(opcional)</span></label>
                                <input type="text" placeholder="Ex: 🥇">
                            </div>

                            <div class="form-grupo form-grupo-full">
                                <label>Descrição</label>
                                <textarea rows="3">Participação da equipe no campeonato interno do IFSC Gaspar.</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer admin-modal-footer">
                        <button class="btn-modal-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn-modal-salvar">Salvar alterações</button>
                    </div>

                </div>
            </div>
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