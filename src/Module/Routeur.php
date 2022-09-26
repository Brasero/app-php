<?php
namespace Module;

use Module\Router\Route;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

/**
 * Class Router
 * Register and match Routes
 */
class Routeur
{
    /**
     *
     * @var FastRouteRouteur
     */
    private $routeur;

     /**
     * Routes disponible
     *
     * @var array
     */
    public $routes = [];

    public function __construct()
    {
        $this->routeur = new FastRouteRouter();
    }

    /**
     * Register a route with get METHOD
     *
     * @param string $path uri of the route
     * @param callable $callable function to call
     * @param string $name name of the route
     * @return void
     */
    public function get(string $path, callable $callable, string $name)
    {
        $this->routeur->addRoute(new ZendRoute($path, $callable, ['GET'], $name));
        $this->routes[] = $name;
    }


    /**
     * Undocumented function
     *
     * @param ServerRequestInterface $request
     * @return ?Route
     */
    public function match(ServerRequestInterface $request): ?Route
    {

        $result = $this->routeur->match($request);
        
        if ($result->isSuccess()) {
            return new Route(
                $result->getMatchedRouteName(),
                $result->getMatchedMiddleware(),
                $result->getMatchedParams()
            );
        }

        return null;
    }

    public function generateUrl(string $name, ?array $params = []): ?string
    {
        return $this->routeur->generateUri($name, $params);
    }
}
