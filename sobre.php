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
    <title>Sobre o Time | StrikeSet Gaspar</title>

    <link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="visual/css/sobre.css?v=<?php echo time(); ?>">
</head>

<body class="pagina-sobre">

<?php require_once __DIR__ . '/includes/header.php'; ?>

<section class="sobre-hero">
    <div class="sobre-hero-text">
        <span class="sobre-hero-tag">StrikeSet Gaspar</span>

        <h1 class="sobre-hero-titulo">Sobre o Time</h1>

        <p class="sobre-hero-desc">
             A StrikeSet Gaspar surgiu dentro do IFSC Gaspar, com alunos que queriam
             montar uma atlética mais organizada para representar a faculdade no vôlei.
        </p>

<p class="sobre-hero-desc">
    O time cresceu com novos integrantes, treinos frequentes e participação
    em campeonatos universitários e regionais.
</p>

        <p class="sobre-hero-desc">
            Hoje o time reúne atletas de vários níveis para treinar,
            disputar campeonatos e representar Gaspar nas quadras da região.
        </p>
    </div>
</section>

<section class="sobre-historia">
    <div class="sobre-historia-inner">


        <h2 class="sobre-section-titulo">Como começou</h2>

        <div class="sobre-historia-card">

            <p>
                A StrikeSet começou dentro do IFSC Gaspar, quando alguns alunos decidiram
                montar um time para representar a atlética nos jogos e campeonatos.
            </p>

            <p>
                No começo eram treinos mais simples e amistosos entre conhecidos, mas aos
                poucos o grupo foi crescendo e ficando mais organizado.
            </p>

            <p>
                Hoje o time continua reunindo alunos e atletas que gostam de competir,
                treinar juntos e fortalecer a atlética dentro e fora das quadras.
            </p>

        </div>
    </div>
</section>

<section class="sobre-mvv">
    <div class="sobre-mvv-inner">


        <h2 class="sobre-section-titulo">O que buscamos</h2>

        <div class="sobre-mvv-grid">

            <div class="mvv-card">
                <div class="mvv-card-icone">🎯</div>

                <h3>Missão</h3>

                <p>
                    Criar um ambiente organizado para treinos, jogos e campeonatos.
                </p>
            </div>

            <div class="mvv-card">
                <div class="mvv-card-icone">🚀</div>

                <h3>Objetivo</h3>

                <p>
                    Melhorar como equipe e disputar campeonatos cada vez mais fortes.
                </p>
            </div>

            <div class="mvv-card">
                <div class="mvv-card-icone">💪</div>

                <h3>Equipe</h3>

                <p>
                    Manter respeito, parceria e comprometimento entre todos do time.
                </p>
            </div>

        </div>
    </div>
</section>

<section class="sobre-diferenciais">
    <div class="sobre-diferenciais-inner">


        <h2 class="sobre-section-titulo">Diferenciais</h2>

        <div class="diferenciais-grid">

            <div class="diferencial-card">
                <span class="diferencial-icone">📅</span>

                <h4>Treinos organizados</h4>

                <p>
                    Atividades planejadas para melhorar técnica e jogo coletivo.
                </p>
            </div>

            <div class="diferencial-card">
                <span class="diferencial-icone">🤝</span>

                <h4>Bom ambiente</h4>

                <p>
                    Um grupo tranquilo para quem quer jogar e evoluir no esporte.
                </p>
            </div>

            <div class="diferencial-card">
                <span class="diferencial-icone">🏆</span>

                <h4>Campeonatos</h4>

                <p>
                    Participação frequente em torneios e competições regionais.
                </p>
            </div>

            <div class="diferencial-card">
                <span class="diferencial-icone">📈</span>

                <h4>Evolução</h4>

                <p>
                    Espaço tanto para iniciantes quanto para jogadores experientes.
                </p>
            </div>

            <div class="diferencial-card">
                <span class="diferencial-icone">🎉</span>

                <h4>Integração</h4>

                <p>
                    O grupo também se reúne fora da quadra para manter a amizade.
                </p>
            </div>

            <div class="diferencial-card">
                <span class="diferencial-icone">🏐</span>

                <h4>Compromisso</h4>

                <p>
                    Treinos levados a sério sem perder o clima leve do time.
                </p>
            </div>

        </div>
    </div>
</section>

<section class="sobre-numeros">
    <div class="sobre-numeros-inner">

        <h2 class="sobre-section-titulo sobre-section-titulo--claro">
            Números do time
        </h2>

        <div class="numeros-grid">

            <div class="numero-item">
                <span class="numero-valor">+15</span>
                <span class="numero-label">Atletas</span>
            </div>

            <div class="numero-item">
                <span class="numero-valor">5</span>
                <span class="numero-label">Campeonatos</span>
            </div>

            <div class="numero-item">
                <span class="numero-valor">2</span>
                <span class="numero-label">Anos</span>
            </div>

        </div>

    </div>
</section>

<section class="sobre-cta">
    <div class="sobre-cta-inner">

        <h2>
            Quer jogar com a gente?
        </h2>

        <p>
            Entre para a StrikeSet Gaspar e participe dos próximos treinos.
        </p>

        <a href="login.php" class="cta-btn">
            QUERO PARTICIPAR
        </a>

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
