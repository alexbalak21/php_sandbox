<?php
/**
 * Class Router
 * A simple router for handling HTTP requests.
 */
class Router {
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
        'PATCH' => []
    ];

    /**
     * Router constructor.
     */
    public function __construct() {
        // No base URI needed
    }

    /**
     * Adds a route to the router.
     * @param string $method The HTTP method (GET, POST, etc.).
     * @param string $uri The request URI.
     * @param callable $callback The callback function to handle the request.
     */
    public function addRoute($method, $uri, $callback) {
        $this->routes[$method][$uri] = $callback;
    }

    /**
     * Dispatches the request to the appropriate route.
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $request = new Request($method, $uri, file_get_contents('php://input'));
        $response = new Response();

        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri], $request, $response);
        } else {
            $response->Body("No route found for $method $uri");
            $response->send();
        }
    }

    /**
     * Destructor to automatically dispatch the request.
     */
    public function __destruct() {
        $this->dispatch();
    }

    /**
     * Adds a GET route.
     * @param string $uri The request URI.
     * @param callable $callback The callback function to handle the request.
     */
    public function GET($uri, $callback) {
        $this->addRoute('GET', $uri, $callback);
    }

    /**
     * Adds a POST route.
     * @param string $uri The request URI.
     * @param callable $callback The callback function to handle the request.
     */
    public function POST($uri, $callback) {
        $this->addRoute('POST', $uri, $callback);
    }

    /**
     * Adds a PUT route.
     * @param string $uri The request URI.
     * @param callable $callback The callback function to handle the request.
     */
    public function PUT($uri, $callback) {
        $this->addRoute('PUT', $uri, $callback);
    }

    /**
     * Adds a DELETE route.
     * @param string $uri The request URI.
     * @param callable $callback The callback function to handle the request.
     */
    public function DELETE($uri, $callback) {
        $this->addRoute('DELETE', $uri, $callback);
    }

    /**
     * Adds a PATCH route.
     * @param string $uri The request URI.
     * @param callable $callback The callback function to handle the request.
     */
    public function PATCH($uri, $callback) {
        $this->addRoute('PATCH', $uri, $callback);
    }
}
?>