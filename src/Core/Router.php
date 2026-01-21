<?php
/**
 * GAC - Router Simple
 * 
 * @package Gac\Core
 */

namespace Gac\Core;

class Router
{
    private array $routes = [];
    private array $middleware = [];
    
    /**
     * Registrar ruta GET
     */
    public function get(string $path, string $handler, array $middleware = []): void
    {
        $this->addRoute('GET', $path, $handler, $middleware);
    }
    
    /**
     * Registrar ruta POST
     */
    public function post(string $path, string $handler, array $middleware = []): void
    {
        $this->addRoute('POST', $path, $handler, $middleware);
    }
    
    /**
     * Agregar ruta
     */
    private function addRoute(string $method, string $path, string $handler, array $middleware): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }
    
    /**
     * Despachar request
     */
    public function dispatch(): void
    {
        $request = new Request();
        $method = $request->method();
        $path = $request->path();
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $path)) {
                // Ejecutar middleware
                foreach ($route['middleware'] as $middlewareName) {
                    $this->executeMiddleware($middlewareName, $request);
                }
                
                // Ejecutar handler
                $this->executeHandler($route['handler'], $request);
                return;
            }
        }
        
        // 404 Not Found
        http_response_code(404);
        echo "404 - Página no encontrada";
    }
    
    /**
     * Verificar si el path coincide
     */
    private function matchPath(string $routePath, string $requestPath): bool
    {
        // Implementación simple (mejorar con regex para parámetros)
        return $routePath === $requestPath;
    }
    
    /**
     * Ejecutar middleware
     */
    private function executeMiddleware(string $middlewareName, Request $request): void
    {
        $middlewareClass = "Gac\\Middleware\\" . ucfirst($middlewareName) . "Middleware";
        
        if (class_exists($middlewareClass)) {
            $middleware = new $middlewareClass();
            $middleware->handle($request);
        } else {
            // Si el middleware no existe, permitir acceso (para desarrollo)
            // En producción, esto debería bloquear el acceso
        }
    }
    
    /**
     * Ejecutar handler
     */
    private function executeHandler(string $handler, Request $request): void
    {
        [$controller, $method] = explode('@', $handler);
        $controllerClass = "Gac\\Controllers\\{$controller}";
        
        if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            if (method_exists($controllerInstance, $method)) {
                $controllerInstance->$method($request);
            }
        }
    }
}
