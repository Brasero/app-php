<?php

namespace Tests\Module;

use Module\App;
use App\Blog\BlogModule;
use App\Accueil\AccueilModule;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\ServerRequest;

class AppTest extends TestCase
{
    // public function testRedirectTrailingSlash()
    // {
    //     $app = new App([]);
    //     $request = new ServerRequest('GET', "/azeaze/");
    //     $response = $app->run($request);
    //     $this->assertContains("/azeaze", $response->getHeader('Location'));
    //     $this->assertEquals(301, $response->getStatusCode());
    // }

    public function testBlog()
    {
        $app = new App([
            BlogModule::class
        ]);
        $request = new ServerRequest('GET', "/blog");
        $requestOne = new ServerRequest('GET', '/blog/article-de-test');
        $response = $app->run($request);
        $this->assertEquals(200, $response->getStatusCode());
        $responseOne = $app->run($requestOne);
        $this->assertEquals(200, $responseOne->getStatusCode());
    }

    public function testError404()
    {
        $app = new App([]);
        $request = new ServerRequest('GET', '/aze');
        $response = $app->run($request);
        $this->assertEquals('<h1>Erreur 404</h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testLandingPage()
    {
        $app = new App([
            AccueilModule::class
        ]);
        $request = new ServerRequest('GET', '/');
        $response = $app->run($request);
        $this->assertEquals(200, $response->getStatusCode());
    } 

    public function testLandingPageAndMore()
    {
        $app = new App([
            BlogModule::class,
            AccueilModule::class
        ]);
        $request = new ServerRequest('GET', '/');
        $response = $app->run($request);
        $this->assertEquals(200, $response->getStatusCode());
    } 

}