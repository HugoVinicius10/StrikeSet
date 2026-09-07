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
    <title>StrikeSet Gaspar</title>
    <link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="visual/css/home.css?v=<?php echo time(); ?>">
</head>

<body class="pagina-home">

<?php require_once __DIR__ . '/includes/header.php'; ?>

<section class="hero">
    <div class="hero-img">
        <img src="visual/images/jointeam.png" width="400">
    </div>

    <div class="hero-text">
        <p>Se você curte vôlei, quer melhorar no jogo e ainda fazer parte de um time irado, esse é o seu lugar!</p>
        <p>Aqui rola treino, campeonato e muita resenha.</p>
        <p>Não importa se você já joga faz tempo ou tá começando agora.</p>
        <p>Venha pro time!</p>
        <button>JUNTE-SE</button>
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
