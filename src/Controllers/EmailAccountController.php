<?php
/**
 * GAC - Controlador de Cuentas de Email
 * 
 * @package Gac\Controllers
 */

namespace Gac\Controllers;

use Gac\Core\Request;

class EmailAccountController
{
    /**
     * Listar todas las cuentas de email
     */
    public function index(Request $request): void
    {
        // TODO: Obtener cuentas desde servicio cuando esté implementado
        $emailAccounts = [];
        
        $this->renderView('admin/email_accounts/index', [
            'title' => 'Gestión de Cuentas de Email',
            'email_accounts' => $emailAccounts
        ]);
    }

    /**
     * Mostrar formulario para crear nueva cuenta
     */
    public function create(Request $request): void
    {
        $this->renderView('admin/email_accounts/form', [
            'title' => 'Agregar Cuenta de Email',
            'email_account' => null,
            'mode' => 'create'
        ]);
    }

    /**
     * Guardar nueva cuenta de email
     */
    public function store(Request $request): void
    {
        if ($request->method() !== 'POST') {
            json_response([
                'success' => false,
                'message' => 'Método no permitido'
            ], 405);
            return;
        }

        $email = $request->input('email', '');
        $imap_server = $request->input('imap_server', '');
        $imap_port = $request->input('imap_port', 993);
        $imap_user = $request->input('imap_user', '');
        $imap_password = $request->input('imap_password', '');
        $enabled = $request->input('enabled', 1);

        // Validación
        if (empty($email) || empty($imap_server) || empty($imap_user) || empty($imap_password)) {
            json_response([
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ], 400);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json_response([
                'success' => false,
                'message' => 'El email no es válido'
            ], 400);
            return;
        }

        // TODO: Implementar guardado cuando esté el servicio listo
        json_response([
            'success' => false,
            'message' => 'Funcionalidad en desarrollo'
        ], 503);
    }

    /**
     * Mostrar formulario para editar cuenta
     */
    public function edit(Request $request): void
    {
        $id = $request->get('id', 0);
        
        // TODO: Obtener cuenta desde servicio
        $emailAccount = null;
        
        if (!$emailAccount) {
            http_response_code(404);
            echo "Cuenta no encontrada";
            return;
        }

        $this->renderView('admin/email_accounts/form', [
            'title' => 'Editar Cuenta de Email',
            'email_account' => $emailAccount,
            'mode' => 'edit'
        ]);
    }

    /**
     * Actualizar cuenta de email
     */
    public function update(Request $request): void
    {
        if ($request->method() !== 'POST') {
            json_response([
                'success' => false,
                'message' => 'Método no permitido'
            ], 405);
            return;
        }

        $id = $request->input('id', 0);
        
        // TODO: Implementar actualización cuando esté el servicio listo
        json_response([
            'success' => false,
            'message' => 'Funcionalidad en desarrollo'
        ], 503);
    }

    /**
     * Eliminar cuenta de email
     */
    public function destroy(Request $request): void
    {
        if ($request->method() !== 'POST') {
            json_response([
                'success' => false,
                'message' => 'Método no permitido'
            ], 405);
            return;
        }

        $id = $request->input('id', 0);
        
        // TODO: Implementar eliminación cuando esté el servicio listo
        json_response([
            'success' => false,
            'message' => 'Funcionalidad en desarrollo'
        ], 503);
    }

    /**
     * Cambiar estado (habilitar/deshabilitar)
     */
    public function toggleStatus(Request $request): void
    {
        if ($request->method() !== 'POST') {
            json_response([
                'success' => false,
                'message' => 'Método no permitido'
            ], 405);
            return;
        }

        $id = $request->input('id', 0);
        $enabled = $request->input('enabled', 0);
        
        // TODO: Implementar cambio de estado cuando esté el servicio listo
        json_response([
            'success' => false,
            'message' => 'Funcionalidad en desarrollo'
        ], 503);
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
