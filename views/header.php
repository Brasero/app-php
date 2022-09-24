<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site</title>
</head>
<body>
    <header>
        <nav>
            <?php foreach($this->paths as $route): ?>
                <a href="<?= $router->generateUri($route); ?>">
                    <button>
                        <?= $route ?>
                    </button>
                </a>
            <?php endforeach; ?>
        </nav>
    </header>