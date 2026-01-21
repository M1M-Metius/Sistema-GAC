<?php
/**
 * GAC - Funciones Helper Globales
 * 
 * @package Gac\Helpers
 */

if (!function_exists('gac_version')) {
    /**
     * Obtener versión de GAC
     */
    function gac_version(): string
    {
        return defined('GAC_VERSION') ? GAC_VERSION : '2.0.0';
    }
}

if (!function_exists('gac_name')) {
    /**
     * Obtener nombre de GAC
     */
    function gac_name(): string
    {
        return defined('GAC_NAME') ? GAC_NAME : 'GAC';
    }
}

if (!function_exists('base_path')) {
    /**
     * Obtener ruta base del proyecto
     */
    function base_path(string $path = ''): string
    {
        $basePath = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__, 2);
        return $basePath . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}

if (!function_exists('public_path')) {
    /**
     * Obtener ruta pública
     */
    function public_path(string $path = ''): string
    {
        $publicPath = defined('PUBLIC_PATH') ? PUBLIC_PATH : base_path('public');
        return $publicPath . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}

if (!function_exists('env')) {
    /**
     * Obtener variable de entorno
     */
    function env(string $key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}

if (!function_exists('config')) {
    /**
     * Obtener configuración
     */
    function config(string $key, $default = null)
    {
        // Implementar según necesidad
        return $default;
    }
}

if (!function_exists('dd')) {
    /**
     * Dump and Die (solo en desarrollo)
     */
    function dd(...$vars)
    {
        if (defined('APP_DEBUG') && APP_DEBUG) {
            foreach ($vars as $var) {
                var_dump($var);
            }
            die();
        }
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirigir a URL
     */
    function redirect(string $url, int $code = 302): void
    {
        header("Location: {$url}", true, $code);
        exit;
    }
}

if (!function_exists('view')) {
    /**
     * Cargar vista
     */
    function view(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = base_path('views/' . str_replace('.', '/', $view) . '.php');
        
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            throw new Exception("Vista no encontrada: {$view}");
        }
    }
}

if (!function_exists('json_response')) {
    /**
     * Enviar respuesta JSON
     */
    function json_response(array $data, int $code = 200): void
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
