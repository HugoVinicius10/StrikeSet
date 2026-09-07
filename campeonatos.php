<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campeonatos | StrikeSet Gaspar</title>
    <link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="visual/css/campeonatos.css?v=<?php echo time(); ?>">
</head>

<body class="pagina-campeonatos">

<?php require_once __DIR__ . '/includes/header.php'; ?>

<section class="camp-hero">
    <div class="camp-hero-overlay"></div>
    <div class="camp-hero-inner">

        <div class="camp-hero-esquerda">
            <span class="camp-tag">StrikeSet Gaspar</span>
            <h1>Campeonatos</h1>
            <p>A StrikeSet compete em torneios universitários e regionais ao longo do ano, representando o IFSC Gaspar dentro e fora de quadra.</p>
        </div>

        <div class="camp-hero-direita">
            <a href="galeria.php" class="hero-galeria-btn">Ver galeria de fotos</a>
        </div>

    </div>
</section>

<section class="proximos">
    <div class="sec-inner">
        <div class="linha"></div>
        <h2>Próximos campeonatos</h2>
        <div class="proximos-grid">

            <div class="camp-card">
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
                <a href="login.php" class="camp-btn">Ver detalhes</a>
            </div>

            <div class="camp-card">
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
                <a href="login.php" class="camp-btn">Ver detalhes</a>
            </div>

            <div class="camp-card">
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
                <a href="login.php" class="camp-btn">Ver detalhes</a>
            </div>

        </div>
    </div>
</section>

<section class="disputados">
    <div class="sec-inner">
        <div class="linha"></div>
        <h2>Campeonatos disputados</h2>
        <div class="disputados-lista">

            <div class="disp-card">
                <div class="disp-ano">2026</div>
                <div class="disp-corpo">
                    <div class="disp-topo">
                        <h3>Copa IFSC de Vôlei</h3>
                        <span class="disp-coloc coloc-prata">2º lugar</span>
                    </div>
                </div>
            </div>

            <div class="disp-card">
                <div class="disp-ano">2025</div>
                <div class="disp-corpo">
                    <div class="disp-topo">
                        <h3>Torneio Integração IFSC</h3>
                        <span class="disp-coloc coloc-ouro">1º lugar</span>
                    </div>
                </div>
            </div>

            <div class="disp-card">
                <div class="disp-ano">2025</div>
                <div class="disp-corpo">
                    <div class="disp-topo">
                        <h3>Regional Universitário SC</h3>
                        <span class="disp-coloc coloc-bronze">3º lugar</span>
                    </div>
                </div>
            </div>

            <div class="disp-card">
                <div class="disp-ano">2025</div>
                <div class="disp-corpo">
                    <div class="disp-topo">
                        <h3>Copa Gaspar de Vôlei</h3>
                        <span class="disp-coloc coloc-prata">2º lugar</span>
                    </div>
                </div>
            </div>

            <div class="disp-card">
                <div class="disp-ano">2024</div>
                <div class="disp-corpo">
                    <div class="disp-topo">
                        <h3>Torneio Amistoso Vale do Itajaí</h3>
                        <span class="disp-coloc coloc-neutro">4º lugar</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="conquistas">
    <div class="sec-inner">
        <div class="linha"></div>
        <h2>Conquistas</h2>
        <div class="conquistas-grid">

            <div class="conq-card">
                <div class="conq-icone">🥈</div>
                <h4>Vice-campeão regional</h4>
                <p>Copa IFSC 2026</p>
            </div>

            <div class="conq-card">
                <div class="conq-icone">🥇</div>
                <h4>Campeão integração IFSC</h4>
                <p>Torneio IFSC 2025</p>
            </div>

            <div class="conq-card">
                <div class="conq-icone">🛡️</div>
                <h4>Melhor defesa</h4>
                <p>Regional SC 2025</p>
            </div>

            <div class="conq-card">
                <div class="conq-icone">🏐</div>
                <h4>Destaque universitário</h4>
                <p>Copa Gaspar 2025</p>
            </div>

            <div class="conq-card">
                <div class="conq-icone">💥</div>
                <h4>Melhor saque</h4>
                <p>Torneio Integração 2025</p>
            </div>

            <div class="conq-card">
                <div class="conq-icone">📈</div>
                <h4>Maior evolução</h4>
                <p>Avaliação interna 2024</p>
            </div>

        </div>
    </div>
</section>

<section class="camp-cta">
    <div class="camp-cta-inner">
        <h2>Quer competir com a gente?</h2>
        <p>A StrikeSet está sempre buscando novos atletas. Se você gosta de vôlei e quer fazer parte dos próximos campeonatos, vem conversar com a gente.</p>
        <a href="login.php" class="cta-btn">QUERO PARTICIPAR</a>
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

</body>
</html>

