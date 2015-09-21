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
        $this->assertNotNull($this->routeCol->getByName($name));
    }

    protected function assertHasRoute($method, $uri)
    {
        $this->getRoutes();
        $this->assertTrue(array_key_exists("$method.$uri", $this->routes));
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
}
