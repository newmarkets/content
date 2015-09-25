<?php
namespace Content\Tests;

class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * @var \Illuminate\Routing\RouteCollection
     */
    protected $routeCol;

    protected $routes = [];

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../../../../../../bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    protected function assertHasNamedRoute($name)
    {
        $this->getRoutes();
        $this->assertNotNull($this->routeCol->getByName($name), "Missing named route $name");
    }

    protected function assertHasRoute($method, $uri)
    {
        $this->getRoutes();
        $this->assertTrue(array_key_exists("$method.$uri", $this->routes), "Missing route ($method) $uri");
    }

    protected function getRoutes()
    {

        if (isset($this->routeCol)) {
            return;
        }

        $this->routeCol = $this->app['router']->getRoutes();

        $routes = $this->routeCol->getRoutes();

        array_walk($routes, function ($route) {

            foreach ($route->getMethods() as $method) {
                $this->routes[$method . '.' . $route->getUri()] = true;
            }

        });

    }

    public function assertHasResourceRoute($uri, $except = [], $id = 'id')
    {
        $standardRoutes = [
            'index' => ['GET', ''],
            'create' => ['GET', '/create'],
            'store' => ['POST', ''],
            'show' => ['GET', '/{'.$id.'}'],
            'edit' => ['GET', '/{'.$id.'}/edit'],
            'update' => ['PUT', '/{'.$id.'}'],
            'update_' => ['PATCH', '/{'.$id.'}'],
            'destroy' => ['DELETE', '/{'.$id.'}']
        ];

        $this->getRoutes();

        foreach($standardRoutes as $action => $params) {

            $action = trim($action, '_');

            if (!in_array($action, $except)) {

                list($method, $path) = $params;

                $this->assertTrue(array_key_exists($method.'.'.$uri.$path, $this->routes),
                    "Missing $action route ($method) $uri$path");

            }

        }
    }
}
