<?php
/**
 * GAC - Vista de Gestión de Clientes (En Construcción)
 */

$content = ob_start();
?>

<div class="admin-container">
    <div class="admin-header">
        <div class="building-header">
            <a href="/admin/dashboard" class="building-back-button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Volver al Dashboard
            </a>
        </div>
        <h1 class="admin-title">Gestión de Clientes</h1>
    </div>

    <div class="admin-content">
        <div class="building-container">
            <div class="building-icon">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h2 class="building-title">Página en Construcción</h2>
            <p class="building-description">
                Esta sección está siendo desarrollada. Pronto podrás gestionar usuarios, clientes y sus permisos de acceso al sistema.
            </p>
            <div class="building-features">
                <div class="feature-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Gestión de usuarios</span>
                </div>
                <div class="feature-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>Control de permisos</span>
                </div>
                <div class="feature-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    <span>Roles y accesos</span>
                </div>
                <div class="feature-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span>Historial de actividad</span>
                </div>
            </div>
            <div class="building-progress">
                <div class="progress-bar">
                    <div class="progress-fill progress-30"></div>
                </div>
                <p class="progress-text">30% completado</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$title = $title ?? 'Gestión de Clientes';
$show_nav = true;
$footer_text = '';
$footer_whatsapp = false;
$additional_css = ['/assets/css/admin/main.css', '/assets/css/admin/building.css'];
$additional_js = [];

require base_path('views/layouts/main.php');
?>
