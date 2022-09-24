<?php
namespace Tests\Module;

use Module\Routeur;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\ServerRequest;

class RouterTest extends TestCase
{

    /**
     *
     * @var Routeur
     */
    private $router;

    public function setUp(): void
    {
        $this->router = new Routeur();
    }

    public function testGetMethod()
    {
        $request = new ServerRequest('GET', '/blog');
        $this->router->get('/blog', function() { return 'hello'; }, 'blog');
        $route = $this->router->match($request);
        $this->assertEquals('blog', $route->getName());
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
    }

    public function testGetMethodIfUrlDoesNotExists()
    {
        $request = new ServerRequest('GET', '/blogaze');
        $this->router->get('/blog', function() { return 'hello'; }, 'blog');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }

    public function testGetMethodWithParams()
    {
        $request = new ServerRequest('GET', '/blog/mon-slug-8');
        $this->router->get('/blog', function() {return 'azeaze'; }, 'posts');
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function() { return 'hello'; }, 'post.show');
        $route = $this->router->match($request);
        $this->assertEquals('post.show', $route->getName());
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
        $this->assertEquals(['slug' => 'mon-slug', 'id' => '8'], $route->getParams());
        //Test invalid url
        $route = $this->router->match(new ServerRequest('GET', '/blog/mon_slug-18'));
        $this->assertEquals(null, $route);
    }

    public function testGenerateUri()
    {
        $this->router->get('/blog', function() {return 'azeaze'; }, 'posts');
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function() { return 'hello'; }, 'post.show');
        $uri = $this->router->generateUrl('post.show', ['slug' => 'mon-article', 'id' => 18]);
        $this->assertEquals('/blog/mon-article-18', $uri);
    }
}