<?php
namespace App\Blog;

use Module\Routeur;
use Module\Renderer;
use Psr\Http\Message\ServerRequestInterface;

class BlogModule
{

    private $renderer;

    public function __construct(Routeur $routeur)
    {
        $this->renderer = new Renderer();
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $routeur->get('/blog', [$this, 'index'], 'blog.index');
        $routeur->get('/blog/{slug:[a-z\-]+}', [$this, 'show'], 'blog.show');
    }

    public function index(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@blog/index');
    }

    public function show(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $request->getAttribute('slug')
        ]);
    }
}
