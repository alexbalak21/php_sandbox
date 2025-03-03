<?php
class Request {
    public $method;
    public $uri;
    public $body;

    public function __construct($method, $uri, $body) {
        $this->method = $method;
        $this->uri = $uri;
        $this->body = $body;
    }
}

class Response {
    private $headers = [];
    private $body;

    public function setHeader($name, $value) {
        $this->headers[$name] = $value;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function send() {
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $this->body;
    }
}

class Rooter {
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    public function addRoute($method, $uri, $callback) {
        $this->routes[$method][$uri] = $callback;
    }

    public function dispatch($method, $uri) {
        $request = new Request($method, $uri, file_get_contents('php://input'));
        $response = new Response();

        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri], $request, $response);
        } else {
            $response->setBody("No route found for $method $uri");
            $response->send();
        }
    }

    public function GET($uri, $callback) {
        $this->addRoute('GET', $uri, $callback);
    }

    public function POST($uri, $callback) {
        $this->addRoute('POST', $uri, $callback);
    }

    public function PUT($uri, $callback) {
        $this->addRoute('PUT', $uri, $callback);
    }

    public function DELETE($uri, $callback) {
        $this->addRoute('DELETE', $uri, $callback);
    }
}

// Example usage
$rooter = new Rooter();

$rooter->GET('/example', function($request, $response) {
    $response->setBody("GET request to " . $request->uri);
    $response->send();
});

$rooter->POST('/example', function($request, $response) {
    $response->setBody("POST request to " . $request->uri . " with body: " . $request->body);
    $response->send();
});

// Dispatch the request
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$rooter->dispatch($method, $uri);
?>