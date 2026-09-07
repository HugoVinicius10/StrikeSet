<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

?>

<header>

    <h2>StrikeSet Gaspar</h2>

    <nav>

        <a href="admin_treinos.php">
            Treinos
        </a>

        <a href="admin_campeonatos.php">
            Campeonatos
        </a>

        <a href="admin_galeria.php">
            Galeria
        </a>

        <span class="admin-badge">
            PAINEL ADMIN
        </span>

        <a
            class="btn-login"
            href="logout.php"
        >
            Sair
        </a>

    </nav>

</header>