<?php
/**
 * GAC - Controlador de Códigos
 * 
 * @package Gac\Controllers
 */

namespace Gac\Controllers;

use Gac\Core\Request;

class CodeController
{
    /**
     * Mostrar página de consulta de códigos
     */
    public function consult(Request $request): void
    {
        // Obtener plataformas disponibles (por ahora hardcodeadas, luego desde BD)
        $platforms = [
            'netflix' => 'Netflix',
            'disney' => 'Disney+',
            'prime' => 'Amazon Prime Video',
            'spotify' => 'Spotify',
            'crunchyroll' => 'Crunchyroll',
            'paramount' => 'Paramount+',
            'chatgpt' => 'ChatGPT',
            'canva' => 'Canva'
        ];

        // Si es POST, procesar consulta
        if ($request->method() === 'POST') {
            $this->processConsult($request);
            return;
        }

        // Mostrar vista de consulta
        $this->renderView('codes/consult', [
            'platforms' => $platforms,
            'title' => 'Consulta tu Código'
        ]);
    }

    /**
     * Procesar consulta de código
     */
    private function processConsult(Request $request): void
    {
        $email = $request->input('email', '');
        $username = $request->input('username', '');
        $platform = $request->input('platform', '');

        // Validación básica
        if (empty($email) || empty($username) || empty($platform)) {
            json_response([
                'success' => false,
                'message' => 'Por favor completa todos los campos'
            ], 400);
            return;
        }

        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json_response([
                'success' => false,
                'message' => 'El email ingresado no es válido'
            ], 400);
            return;
        }

        // Validar usuario (mínimo 3 caracteres)
        if (strlen(trim($username)) < 3) {
            json_response([
                'success' => false,
                'message' => 'El usuario debe tener al menos 3 caracteres'
            ], 400);
            return;
        }

        // TODO: Implementar lógica de consulta real cuando esté lista la BD
        // Por ahora, respuesta mock
        json_response([
            'success' => false,
            'message' => 'Sistema en desarrollo. La funcionalidad estará disponible pronto.'
        ], 503);
    }

    /**
     * API endpoint para consulta AJAX
     */
    public function apiConsult(Request $request): void
    {
        // Solo aceptar POST
        if ($request->method() !== 'POST') {
            json_response([
                'success' => false,
                'message' => 'Método no permitido'
            ], 405);
            return;
        }

        // Obtener datos del JSON body
        $email = $request->input('email', '');
        $username = $request->input('username', '');
        $platform = $request->input('platform', '');

        // Validación básica
        if (empty($email) || empty($username) || empty($platform)) {
            json_response([
                'success' => false,
                'message' => 'Por favor completa todos los campos'
            ], 400);
            return;
        }

        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json_response([
                'success' => false,
                'message' => 'El email ingresado no es válido'
            ], 400);
            return;
        }

        // Validar usuario (mínimo 3 caracteres)
        if (strlen(trim($username)) < 3) {
            json_response([
                'success' => false,
                'message' => 'El usuario debe tener al menos 3 caracteres'
            ], 400);
            return;
        }

        // TODO: Implementar lógica de consulta real cuando esté lista la BD
        // Por ahora, respuesta mock
        json_response([
            'success' => false,
            'message' => 'Sistema en desarrollo. La funcionalidad estará disponible pronto.',
            'platform' => $platform
        ], 503);
    }

    /**
     * Listar códigos recibidos (vista administrativa)
     */
    public function index(Request $request): void
    {
        $this->renderView('admin/codes/index', [
            'title' => 'Códigos Recibidos'
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
