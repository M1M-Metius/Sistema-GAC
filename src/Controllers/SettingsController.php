<?php
/**
 * GAC - Controlador de Configuración
 */

namespace Gac\Controllers;

use Gac\Core\Request;

class SettingsController
{
    public function index(Request $request): void
    {
        $this->renderView('admin/settings/index', [
            'title' => 'Configuración',
            'message' => 'Esta sección de configuración está en construcción.'
        ]);
    }

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
