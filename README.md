# R606_eval
Édité par Romain DURAND

## Lancer le projet 

Lancer la dockerisation :
```bash
docker compose up -d --build
```

Accéder à la page web : http://localhost:8080/src


## Linter + Tests

```bash
docker run --rm -v "${PWD}:/app" -w /app ghcr.io/phpstan/phpstan:2 analyse --no-progress --configuration=phpstan.neon

docker compose exec -T web php tests/db_connection_test.php

docker compose exec -T web php tests/page_load_test.php
```

