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
            <a href="<?= $routeur->generateUrl('accueil.index'); ?>">Accueil</a>
            <a href="<?= $routeur->generateUrl('blog.index'); ?>">Blog</a>
        </nav>
    </header>