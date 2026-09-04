<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (
    !isset($_SESSION['usuario_id']) ||
    ($_SESSION['tipo'] ?? '') !== 'admin'
) {
    header('Location: login.php');
    exit;
}