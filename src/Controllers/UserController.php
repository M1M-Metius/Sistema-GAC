<?php
/**
 * GAC - Controlador de Usuarios/Clientes
 * 
 * @package Gac\Controllers
 */

namespace Gac\Controllers;

use Gac\Core\Request;

class UserController
{
    /**
     * Listar todos los clientes/usuarios
     */
    public function index(Request $request): void
    {
        $this->renderView('admin/users/index', [
            'title' => 'Gestión de Clientes'
        ]);
    }

    /**
     * Renderizar vista
     */
    private function renderView(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = base_path('views/' . str_replace('.', '/', $view) . '.php');
        
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            http_response_code(404);
            echo "Vista no encontrada: {$view}";
        }
    }
}
