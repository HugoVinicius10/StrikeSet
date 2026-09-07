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

        <div class="treino-card">
            <div class="dia-tag">SEG</div>
            <div class="treino-card-body">
                <h5>Fundamentos</h5>
                <p class="horario"> 19h00 - 21h00</p>
                <p class="descricao">Saque, manchete, toque e recepção.</p>
                <span class="nivel iniciante">Iniciante</span>
            </div>
        </div>

        <div class="treino-card">
            <div class="dia-tag">TER</div>
            <div class="treino-card-body">
                <h5>Preparação Física</h5>
                <p class="horario"> 19h00 - 20h30</p>
                <p class="descricao">Força, explosão e condicionamento.</p>
                <span class="nivel todos">Todos os níveis</span>
            </div>
        </div>

        <div class="treino-card">
            <div class="dia-tag">QUA</div>
            <div class="treino-card-body">
                <h5>Tático Coletivo</h5>
                <p class="horario"> 19h00 - 21h30</p>
                <p class="descricao">Sistemas de jogo, posicionamento e jogadas ensaiadas.</p>
                <span class="nivel avancado">Avançado</span>
            </div>
        </div>

        <div class="treino-card">
            <div class="dia-tag">QUI</div>
            <div class="treino-card-body">
                <h5>Ataque e Bloqueio</h5>
                <p class="horario"> 19h00 - 21h00</p>
                <p class="descricao">Treino específico de cortada, largada e bloqueio na rede.</p>
                <span class="nivel intermediario">Intermediário</span>
            </div>
        </div>

        <div class="treino-card">
            <div class="dia-tag">SEX</div>
            <div class="treino-card-body">
                <h5>Jogo Treino</h5>
                <p class="horario"> 19h30 - 22h00</p>
                <p class="descricao">Coletivo entre o time pra fechar a semana.</p>
                <span class="nivel todos">Todos os níveis</span>
            </div>
        </div>

        <div class="treino-card">
            <div class="dia-tag">SAB</div>
            <div class="treino-card-body">
                <h5>Amistosos</h5>
                <p class="horario"> 15h00 - 18h00</p>
                <p class="descricao">Jogos contra outros times da região.</p>
                <span class="nivel avancado">Avançado</span>
            </div>
        </div>

    </div>

    <div class="inscricao-wrapper">
        <div class="inscricao-card">
            <h2>Inscreva-se em um Treino</h2>
            <p class="inscricao-sub">Preencha os dados abaixo e garanta sua vaga.</p>

            <form id="formInscricao" class="inscricao-form" novalidate>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" maxlength="255" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telefone">Telefone (WhatsApp)</label>
                        <input type="tel" id="telefone" name="telefone" maxlength="20" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="treino">Qual treino você quer fazer?</label>
                    <select id="treino" name="treino" required>
                        <option value="">Selecione um treino...</option>
                        <option value="seg">Segunda - Fundamentos (19h00)</option>
                        <option value="ter">Terça - Preparação Física (19h00)</option>
                        <option value="qua">Quarta - Tático Coletivo (19h00)</option>
                        <option value="qui">Quinta - Ataque e Bloqueio (19h00)</option>
                        <option value="sex">Sexta - Jogo Treino (19h30)</option>
                        <option value="sab">Sábado - Amistosos (15h00)</option>
                    </select>
                </div>
                <button type="submit" class="btn-inscrever">QUERO ME INSCREVER</button>

                <p class="form-feedback" id="formFeedback"></p>
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

<script>
    const form = document.getElementById('formInscricao');
    const feedback = document.getElementById('formFeedback');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        feedback.className = 'form-feedback';
        feedback.textContent = '';

        const nome = document.getElementById('nome').value.trim();
        const email = document.getElementById('email').value.trim();
        const telefone = document.getElementById('telefone').value.trim();
        const nivel = document.getElementById('nivel').value;
        const treino = document.getElementById('treino').value;

        if (!nome || nome.length < 3) {
            feedback.textContent = '⚠️ Informe seu nome completo (mínimo 3 caracteres).';
            feedback.classList.add('erro');
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            feedback.textContent = '⚠️ E-mail inválido.';
            feedback.classList.add('erro');
            return;
        }

        if (telefone.length < 8) {
            feedback.textContent = '⚠️ Informe um telefone válido.';
            feedback.classList.add('erro');
            return;
        }
        feedback.textContent = '✅ Inscrição enviada! Em breve entraremos em contato.';
        feedback.classList.add('sucesso');
        form.reset();
    });
</script>

</body>
</html>
