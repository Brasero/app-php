<?php

use Module\App;
use Twig\Environment;
use App\Blog\BlogModule;
use App\Accueil\AccueilModule;
use GuzzleHttp\Psr7\ServerRequest;
use Module\Renderer;
use Twig\Loader\FilesystemLoader;

require "../vendor/autoload.php";

$renderer = new Renderer(dirname(__DIR__).'\views');

$loader = new FilesystemLoader(dirname(__DIR__).'/views');
$twig = new Environment($loader, []);

$app = new App([
    BlogModule::class,
    AccueilModule::class
], [
    'renderer' => $renderer
]);

$response = $app->run(ServerRequest::fromGlobals());

\Http\Response\send($response);