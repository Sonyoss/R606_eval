<?php

declare(strict_types=1);

$url = getenv('APP_URL') ?: 'http://localhost/src/';

$content = @file_get_contents($url);
if ($content === false) {
    fwrite(STDERR, "ECHEC: Impossible de charger la page {$url}.\n");
    exit(1);
}

$expectedSnippet = 'R6.06 Maintenance applicative';
if (strpos($content, $expectedSnippet) === false) {
    fwrite(STDERR, "ECHEC: La page est accessible mais le contenu attendu est absent.\n");
    exit(1);
}

fwrite(STDOUT, "OK: La page {$url} se charge correctement.\n");
exit(0);
