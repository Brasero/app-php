<?php

namespace Module;

/**
 * Contient l'application php qui renvoie un objet de Type ResponseInterface
 */

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{

    /**
     * List of modules
     *
     * @var array
     */
    private $modules = [];

    /**
     * Routeur
     *
     * @var Routeur
     */
    private $routeur;


    /**
     * App constructor
     *
     * @param string[] $modules Liste des modules à charger
     */
    public function __construct(array $modules = [], array $dependencies = [])
    {

        $this->routeur = new Routeur();

        if (array_key_exists('renderer', $dependencies)) {
            $dependencies['renderer']->addGlobal('routeur', $this->routeur);
        }

        foreach ($modules as $module) {
            $this->modules[] = new $module($this->routeur, $dependencies['renderer']);
        }
    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        // $uri = $request->getUri()->getPath();
        // if (!empty($uri) && $uri[-1] === "/") {
        //     return (new Response())
        //         ->withStatus(301)
        //         ->withHeader('Location', substr($uri, 0, -1));
        // }
        $route = $this->routeur->match($request);
        if (is_null($route)) {
            return new Response(404, [], "<h1>Erreur 404</h1>");
        }
        $params = $route->getParams();
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);
        $response = call_user_func_array($route->getCallback(), [$request]);
        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception('The response is not a string or an instance of ResponseInterface');
        }
    }
}
