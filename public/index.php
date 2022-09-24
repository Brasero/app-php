<?php

use App\Accueil\AccueilModule;
use App\Blog\BlogModule;
use Module\App;
use GuzzleHttp\Psr7\ServerRequest;

require "../vendor/autoload.php";

$app = new App([
    BlogModule::class,
    AccueilModule::class
]);

$response = $app->run(ServerRequest::fromGlobals());

\Http\Response\send($response);