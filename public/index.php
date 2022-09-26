<?php

use Module\App;
use App\Blog\BlogModule;
use App\Accueil\AccueilModule;
use GuzzleHttp\Psr7\ServerRequest;
use Module\Renderer\TwigRenderer;

require "../vendor/autoload.php";

$renderer = new TwigRenderer(dirname(__DIR__).'\views');


$app = new App([
    BlogModule::class,
    AccueilModule::class
], [
    'renderer' => $renderer
]);

$response = $app->run(ServerRequest::fromGlobals());

\Http\Response\send($response);