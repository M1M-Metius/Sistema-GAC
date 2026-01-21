<?php
/**
 * GAC - Vista del Dashboard Principal
 */

$content = ob_start();
?>

<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">Dashboard</h1>
    </div>

    <div class="dashboard-content">
        <!-- Paneles de Estadísticas -->
        <div class="stats-grid">
            <!-- Panel: Correos Agregados -->
            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div class="stat-card-content">
                    <h3 class="stat-card-title">Correos Agregados</h3>
                    <p class="stat-card-value" id="emailAccountsCount"><?= number_format($stats['email_accounts']) ?></p>
                    <a href="/admin/email-accounts" class="stat-card-link">
                        Ver todos <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Panel: Códigos Recibidos -->
            <div class="stat-card stat-card-success">
                <div class="stat-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                </div>
                <div class="stat-card-content">
                    <h3 class="stat-card-title">Códigos Recibidos</h3>
                    <p class="stat-card-value" id="codesReceivedCount"><?= number_format($stats['codes_received']) ?></p>
                    <a href="/admin/codes" class="stat-card-link">
                        Ver todos <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Panel: Clientes -->
            <div class="stat-card stat-card-info">
                <div class="stat-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="stat-card-content">
                    <h3 class="stat-card-title">Clientes</h3>
                    <p class="stat-card-value" id="clientsCount"><?= number_format($stats['clients']) ?></p>
                    <a href="/admin/users" class="stat-card-link">
                        Ver todos <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$title = $title ?? 'Dashboard';
$show_nav = true;
$footer_text = '';
$footer_whatsapp = false;
$additional_css = ['/assets/css/admin/main.css', '/assets/css/admin/dashboard.css'];
$additional_js = ['/assets/js/admin/dashboard.js'];

require base_path('views/layouts/main.php');
?>
