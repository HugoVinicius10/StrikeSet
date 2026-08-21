<?php

$host = "34.123.456.789";
$porta = "5432";
$banco = "atletica";
$usuario = "hugoapp";
$senha = "SUA_SENHA";

try {

    $conn = new PDO(
        "pgsql:host=$host;port=$porta;dbname=$banco",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {

    die("Erro na conexão: " . $e->getMessage());

}
?>
