<?php

class Router
{
    private array $routes = ['GET' => [], 'POST' => []];

    public function get(string $path, string $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $route = $_GET['r'] ?? '/';
        $handler = $this->routes[$method][$route] ?? null;
        if (!$handler) {
            http_response_code(404);
            echo "Route not found: [$method] $route";
            return;
        }
        [$controllerName, $action] = explode('@', $handler);
        $file = __DIR__ . '/../controllers/' . $controllerName . '.php';
        if (!file_exists($file)) {
            http_response_code(500);
            echo "Controller not found: $controllerName";
            return;
        }
        require_once $file;
        if (!class_exists($controllerName)) {
            http_response_code(500);
            echo "Controller class missing: $controllerName";
            return;
        }
        $ctrl = new $controllerName();
        if (!method_exists($ctrl, $action)) {
            http_response_code(500);
            echo "Action not found: $action";
            return;
        }
        $ctrl->$action();
    }
}
