# R606_eval
Édité par Romain DURAND

## Lancer le projet 

Lancer la dockerisation :
```bash
docker compose up -d
```

Accéder à la page web : http://localhost:8080/src


## Tests

```bash
docker compose exec -T web php tests/db_connection_test.php
docker compose exec -T web php tests/page_load_test.php
```

