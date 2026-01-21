<?php
/**
 * GAC - Vista de Códigos Recibidos (En Construcción)
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
        <h1 class="admin-title">Códigos Recibidos</h1>
    </div>

    <div class="admin-content">
        <div class="building-container">
            <div class="building-icon">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 21h18"></path>
                    <path d="M5 21V7l8-4v18"></path>
                    <path d="M19 21V11l-6-4"></path>
                    <line x1="9" y1="9" x2="9" y2="21"></line>
                    <line x1="9" y1="12" x2="9" y2="12"></line>
                </svg>
            </div>
            <h2 class="building-title">Página en Construcción</h2>
            <p class="building-description">
                Esta sección está siendo desarrollada. Pronto podrás gestionar y visualizar todos los códigos recibidos desde las diferentes plataformas.
            </p>
            <div class="building-features">
                <div class="feature-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <span>Listado completo de códigos</span>
                </div>
                <div class="feature-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>Filtros avanzados</span>
                </div>
                <div class="feature-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <span>Exportación de datos</span>
                </div>
                <div class="feature-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                    <span>Estadísticas y reportes</span>
                </div>
            </div>
            <div class="building-progress">
                <div class="progress-bar">
                    <div class="progress-fill progress-45"></div>
                </div>
                <p class="progress-text">45% completado</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$title = $title ?? 'Códigos Recibidos';
$show_nav = true;
$footer_text = '';
$footer_whatsapp = false;
$additional_css = ['/assets/css/admin/main.css', '/assets/css/admin/building.css'];
$additional_js = [];

require base_path('views/layouts/main.php');
?>
