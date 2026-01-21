<?php
/**
 * GAC - Router para servidor PHP built-in
 * Este archivo se usa cuando se ejecuta: php -S localhost:8000 -t public router.php
 * 
 * @package Gac\Core
 */

// Si el archivo solicitado existe, servirlo directamente
if (file_exists(__DIR__ . $_SERVER['REQUEST_URI']) && !is_dir(__DIR__ . $_SERVER['REQUEST_URI'])) {
    return false;
}

// Si es un directorio, intentar servir index.php o index.html
if (is_dir(__DIR__ . $_SERVER['REQUEST_URI'])) {
    $indexFiles = ['index.php', 'index.html'];
    foreach ($indexFiles as $indexFile) {
        $indexPath = __DIR__ . $_SERVER['REQUEST_URI'] . '/' . $indexFile;
        if (file_exists($indexPath)) {
            return false; // Dejar que el servidor lo sirva
        }
    }
}

// Para todas las demás rutas, redirigir a index.php
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';
