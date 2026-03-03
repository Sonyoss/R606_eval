<?php

declare(strict_types=1);

$host = getenv('DB_HOST') ?: '';
$user = getenv('DB_USER') ?: '';
$password = getenv('DB_PASSWORD') ?: '';
$database = getenv('DB_NAME') ?: '';

if ($host === '' || $user === '' || $database === '') {
    fwrite(STDERR, "ECHEC: Variables d'environnement BDD manquantes (DB_HOST, DB_USER, DB_NAME).\n");
    exit(1);
}

// Test de la connexion à la BDD
try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$database};charset=utf8mb4",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    $result = $pdo->query('SELECT 1 AS ok')->fetch();

    if (!is_array($result) || (int) ($result['ok'] ?? 0) !== 1) {
        fwrite(STDERR, "ECHEC: La connexion à la BDD a échouée.\n");
        exit(1);
    }

    fwrite(STDOUT, "Connexion à la BDD réussie.\n");
    exit(0);
} catch (Throwable $exception) {
    fwrite(STDERR, 'ECHEC: Connexion BDD impossible - ' . $exception->getMessage() . "\n");
    exit(1);
}
