<?php
/**
 * GAC - Vista de Formulario de Cuenta de Email
 */

$isEdit = ($mode === 'edit' && $email_account !== null);
$content = ob_start();
?>

<div class="admin-container">
    <div class="admin-header">
        <div class="building-header">
            <a href="/admin/email-accounts" class="building-back-button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Volver
            </a>
        </div>
        <h1 class="admin-title"><?= $isEdit ? 'Editar' : 'Agregar' ?> Cuenta de Email</h1>
    </div>

    <div class="admin-content">
        <div class="form-container">
            <form id="emailAccountForm" class="admin-form" novalidate>
                <?php if ($isEdit): ?>
                    <input type="hidden" id="id" name="id" value="<?= $email_account['id'] ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <svg class="form-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        Correo Electrónico <span class="required">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="correo@dominio.com"
                        value="<?= $isEdit ? htmlspecialchars($email_account['email']) : '' ?>"
                        required
                    >
                    <span class="form-error" id="emailError"></span>
                    <small class="form-help">Email del dominio que recibirá los códigos</small>
                </div>

                <div class="form-group">
                    <label for="imap_server" class="form-label">
                        <svg class="form-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                        Servidor IMAP <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="imap_server" 
                        name="imap_server" 
                        class="form-input" 
                        placeholder="imap.dominio.com"
                        value="<?= $isEdit ? htmlspecialchars($email_account['imap_server']) : '' ?>"
                        required
                    >
                    <span class="form-error" id="imapServerError"></span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="imap_port" class="form-label">
                            Puerto IMAP <span class="required">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="imap_port" 
                            name="imap_port" 
                            class="form-input" 
                            placeholder="993"
                            value="<?= $isEdit ? htmlspecialchars($email_account['imap_port']) : '993' ?>"
                            min="1"
                            max="65535"
                            required
                        >
                        <span class="form-error" id="imapPortError"></span>
                    </div>

                    <div class="form-group">
                        <label for="enabled" class="form-label">
                            Estado
                        </label>
                        <select id="enabled" name="enabled" class="form-select">
                            <option value="1" <?= ($isEdit && $email_account['enabled']) ? 'selected' : '' ?>>Activa</option>
                            <option value="0" <?= ($isEdit && !$email_account['enabled']) ? 'selected' : '' ?>>Inactiva</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imap_user" class="form-label">
                        <svg class="form-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Usuario IMAP <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="imap_user" 
                        name="imap_user" 
                        class="form-input" 
                        placeholder="usuario@dominio.com"
                        value="<?= $isEdit ? htmlspecialchars($email_account['imap_user']) : '' ?>"
                        required
                    >
                    <span class="form-error" id="imapUserError"></span>
                </div>

                <div class="form-group">
                    <label for="imap_password" class="form-label">
                        <svg class="form-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        Contraseña IMAP <span class="required">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="imap_password" 
                        name="imap_password" 
                        class="form-input" 
                        placeholder="••••••••"
                        <?= $isEdit ? '' : 'required' ?>
                    >
                    <span class="form-error" id="imapPasswordError"></span>
                    <?php if ($isEdit): ?>
                        <small class="form-help">Dejar en blanco para mantener la contraseña actual</small>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text"><?= $isEdit ? 'Actualizar' : 'Guardar' ?> Cuenta</span>
                        <span class="btn-loader">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 12a9 9 0 11-6.219-8.56"/>
                            </svg>
                        </span>
                    </button>
                    <a href="/admin/email-accounts" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$title = $title ?? ($isEdit ? 'Editar Cuenta de Email' : 'Agregar Cuenta de Email');
$show_nav = true;
$footer_text = '';
$footer_whatsapp = false;
$additional_css = ['/assets/css/admin/main.css', '/assets/css/admin/email_accounts.css'];
$additional_js = ['/assets/js/admin/email_accounts.js'];

require base_path('views/layouts/main.php');
?>
