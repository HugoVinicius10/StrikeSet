<?php

$host = getenv('DB_HOST');
$porta = (int) getenv('DB_PORT');
$usuario = getenv('DB_USER');
$senha = getenv('DB_PASSWORD');
$banco = getenv('DB_NAME');

$conn = mysqli_init();

$ca = __DIR__ . "/certs/ca.pem";

if (!file_exists($ca)) {
    die("Certificado CA não encontrado.");
}

$conn->ssl_set(
    null,
    null,
    $ca,
    null,
    null
);

try {

    $conn->real_connect(
        $host,
        $usuario,
        $senha,
        $banco,
        $porta,
        null,
        MYSQLI_CLIENT_SSL
    );

} catch (mysqli_sql_exception $e) {

    die(
        "Erro na conexão: " .
        $e->getMessage()
    );
}

$conn->set_charset("utf8mb4");

?>