<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$paginaAtual = basename($_SERVER['PHP_SELF']);

?>

<header>
    <h2>StrikeSet Gaspar</h2>

    <nav>
        <a href="home.php">Inicio</a>
        <a href="galeria.php">Galeria</a>
        <a href="sobre.php">Sobre o Time</a>
        <a href="treinos.php">Treinos</a>
        <a href="campeonatos.php">Campeonatos</a>
        <a class="btn-login" href="login.php">LOGIN/REGISTRO</a>
    </nav>
</header>