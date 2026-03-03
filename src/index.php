<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>R6.06 Maintenance applicative</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <header>
        <h1>R6.06 Maintenance applicative</h1>
        <h2 class="red">Evaluation</h2>
        <p class="red">Modifiez ce projet à l'aide des outils vus ensemble pour améliorer la maintenabilité
            de ce projet et déployez le sur le serveur mis à votre disposition</p>
        <p class="red">Vous êtes libre de modifier ce que vous souhaitez sur le projet, chaque amélioration
            (ou début d'amélioration) sera prise en compte dans la notation</p>
        <p class="red cadre">
            Pensez à inviter cdiiv sur votre projet Github</p>
    </header>

    <?php
    // Récupération des variables d'environnements
    $servername = getenv("DB_HOST");
    $username = getenv("DB_USER");
    $password = getenv("DB_PASSWORD");
    $dbname = getenv("DB_NAME");

    // Récupération des données de la BDD
    $p = null;
    $connectionException = null;

    // Tentatives de connexion a la BDD pour laisser le temps a la BDD de se construire
    for ($attempt = 1; $attempt <= 10; $attempt++) {
        try {
            $p = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            $p->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $p->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            break;
        } catch (PDOException $e) {
            $connectionException = $e;
            usleep(500000);
        }
    }

    if ($p === null) {
        echo 'Erreur lors de la connexion à la BDD : ' . $connectionException?->getMessage();
        exit();
    }

    try {
        $d = $p->query("SELECT id,text FROM db_table")->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo 'Erreur lors de la récupération des données : ' . $e->getMessage();
        exit();
    }
    ?>

<!-- Affichage des données récpérées -->
    <table>
        <thead style="font-weight: bold;">
            <tr>
                <td class="tabCell">Id</td>
                <td class="tabCell">Text</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($d as $val) { ?>
                <tr>
                    <td class="tabCell"><?= $val['id'] ?></td>
                    <td class="tabCell"><?= $val['text'] ?></td>
                </tr>
                <?php
            } ?>
        </tbody>
    </table>
</body>

</html>