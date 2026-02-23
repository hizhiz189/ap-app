<?php
/**
 * Simple Router
 */
class Router {
    private $routes = [];

    /**
     * Register a GET route
     */
    public function get($path, $controller) {
        $this->routes['GET'][$path] = $controller;
    }

    /**
     * Register a POST route
     */
    public function post($path, $controller) {
        $this->routes['POST'][$path] = $controller;
    }

    /**
     * Dispatch the request
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove base path (/ap-app/public)
        $basePath = '/ap-app/public';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        
        // Handle root after base path
        if ($uri === '') {
            $uri = '/';
        }
        
        // Remove trailing slash (except for root)
        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        // Check if route exists
        if (isset($this->routes[$method][$uri])) {
            $controller = $this->routes[$method][$uri];
            $this->callController($controller);
        } else {
            // Route not found
            http_response_code(404);
            echo "<h1>404 - Page Not Found</h1>";
            echo "<p>Route: {$uri}</p>";
        }
    }

    /**
     * Call the controller method
     */
    private function callController($controller) {
        if (is_array($controller)) {
            $class = $controller[0];
            $action = $controller[1];
            
            // Check if class file exists
            $classFile = 'controllers/' . $class . '.php';
            if (file_exists($classFile)) {
                require_once $classFile;
                $instance = new $class();
                $instance->$action();
            } else {
                http_response_code(500);
                echo "Controller not found: {$class}";
            }
        }
    }
}
