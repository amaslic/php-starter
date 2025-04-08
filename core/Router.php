<?php

class Router
{
    private $routes = [];

    public function add($method, $path, $handler, $middleware = null)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestPath) {
                if ($route['middleware']) {
                    $userId = call_user_func($route['middleware']);
                    // Store userId globally if needed
                    $GLOBALS['auth_user_id'] = $userId;
                }

                require $route['handler'];
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
    }
}
