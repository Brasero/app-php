<?= $renderer->render('header'); ?>

<h1>Bienvenue sur mon Blog</h1>


<ul>
    <li>
        <a href="<?= $routeur->generateUrl('blog.show', ['slug' => 'mon-article-a']); ?>">Mon article a</a>
    </li>
    <li>
        Article 1
    </li>
    <li>
        Article 1
    </li>
    <li>
        Article 1
    </li>
    <li>
        Article 1
    </li>
</ul>


<?= $renderer->render('footer'); ?>
