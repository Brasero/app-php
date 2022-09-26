<?php
namespace App\Accueil;

use Module\Routeur;
use Module\Renderer;
use Module\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class AccueilModule
{

    private $renderer;

    public function __construct(Routeur $routeur, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('accueil', __DIR__.'/views');
        $routeur->get('/', [$this, 'index'], 'accueil.index');
    }

    public function index(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@accueil/index');
    }
}
