<?php
/**
 * GAC - Controlador del Dashboard
 * 
 * @package Gac\Controllers
 */

namespace Gac\Controllers;

use Gac\Core\Request;

class DashboardController
{
    /**
     * Mostrar dashboard principal
     */
    public function index(Request $request): void
    {
        // TODO: Obtener datos reales cuando esté la BD lista
        $stats = [
            'email_accounts' => $this->getEmailAccountsCount(),
            'codes_received' => $this->getCodesReceivedCount(),
            'clients' => $this->getClientsCount()
        ];

        $this->renderView('admin/dashboard/index', [
            'title' => 'Dashboard',
            'stats' => $stats
        ]);
    }

    /**
     * Obtener cantidad de correos agregados
     */
    private function getEmailAccountsCount(): int
    {
        // TODO: Consultar BD real
        return 0;
    }

    /**
     * Obtener cantidad de códigos recibidos
     */
    private function getCodesReceivedCount(): int
    {
        // TODO: Consultar BD real
        return 0;
    }

    /**
     * Obtener cantidad de clientes
     */
    private function getClientsCount(): int
    {
        // TODO: Consultar BD real
        return 0;
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
