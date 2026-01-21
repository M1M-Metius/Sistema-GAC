<?php
/**
 * GAC - Vista de Listado de Cuentas de Email
 */

$content = ob_start();
?>

<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">Gestión de Cuentas de Email</h1>
        <a href="/admin/email-accounts/create" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Agregar Cuenta
        </a>
    </div>

    <div class="admin-content">
        <!-- Tabla de cuentas -->
        <div class="table-container">
            <table class="admin-table" id="emailAccountsTable">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Servidor IMAP</th>
                        <th>Puerto</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Última Sincronización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($email_accounts)): ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <p class="empty-message">No hay cuentas de email registradas</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($email_accounts as $account): ?>
                            <tr data-id="<?= $account['id'] ?>">
                                <td><?= htmlspecialchars($account['email']) ?></td>
                                <td><?= htmlspecialchars($account['imap_server']) ?></td>
                                <td><?= htmlspecialchars($account['imap_port']) ?></td>
                                <td><?= htmlspecialchars($account['imap_user']) ?></td>
                                <td>
                                    <span class="status-badge status-<?= $account['enabled'] ? 'active' : 'inactive' ?>">
                                        <?= $account['enabled'] ? 'Activa' : 'Inactiva' ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $account['last_sync_at'] ? date('d/m/Y H:i', strtotime($account['last_sync_at'])) : 'Nunca' ?>
                                </td>
                                <td class="actions-cell">
                                    <button class="btn-icon btn-toggle" 
                                            data-id="<?= $account['id'] ?>"
                                            data-enabled="<?= $account['enabled'] ?>"
                                            title="<?= $account['enabled'] ? 'Deshabilitar' : 'Habilitar' ?>">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <?php if ($account['enabled']): ?>
                                                <path d="M18 6L6 18M6 6l12 12"/>
                                            <?php else: ?>
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            <?php endif; ?>
                                        </svg>
                                    </button>
                                    <a href="/admin/email-accounts/edit?id=<?= $account['id'] ?>" 
                                       class="btn-icon btn-edit" 
                                       title="Editar">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    <button class="btn-icon btn-delete" 
                                            data-id="<?= $account['id'] ?>"
                                            title="Eliminar">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$title = $title ?? 'Gestión de Cuentas de Email';
$show_nav = true;
$footer_text = '';
$footer_whatsapp = false;
$additional_css = ['/assets/css/admin/main.css', '/assets/css/admin/email_accounts.css'];
$additional_js = ['/assets/js/admin/email_accounts.js'];

require base_path('views/layouts/main.php');
?>
