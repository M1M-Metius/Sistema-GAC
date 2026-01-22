-- ============================================
-- GAC - Seed de Settings (Asuntos de Email)
-- ============================================
-- Este script inserta los asuntos de email por plataforma
-- basados en el análisis del sistema original

USE gac_operational;

-- Insertar settings de asuntos de email por plataforma
-- Formato: PLATAFORMA_N (donde N es 1, 2, 3, 4)

-- Netflix
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('NETFLIX_1', 'Tu código de acceso temporal de Netflix', 'string', 'Asunto 1 para emails de Netflix'),
('NETFLIX_2', 'Importante: Cómo actualizar tu Hogar con Netflix', 'string', 'Asunto 2 para emails de Netflix'),
('NETFLIX_3', 'Netflix: Tu código de inicio de sesión', 'string', 'Asunto 3 para emails de Netflix'),
('NETFLIX_4', 'Completa tu solicitud de restablecimiento de contraseña', 'string', 'Asunto 4 para emails de Netflix'),
('HABILITAR_NETFLIX', '1', 'boolean', 'Habilitar plataforma Netflix');

-- Disney+
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('DISNEY_1', 'Tu código de acceso único para Disney+', 'string', 'Asunto 1 para emails de Disney+'),
('DISNEY_2', 'Disney+: Código de verificación', 'string', 'Asunto 2 para emails de Disney+'),
('DISNEY_3', 'Disney+: Solicitud de inicio de sesión', 'string', 'Asunto 3 para emails de Disney+'),
('DISNEY_4', 'Disney+: Restablecimiento de contraseña', 'string', 'Asunto 4 para emails de Disney+'),
('HABILITAR_DISNEY', '1', 'boolean', 'Habilitar plataforma Disney+');

-- Amazon Prime Video
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('PRIME_1', 'amazon.com: Sign-in attempt', 'string', 'Asunto 1 para emails de Amazon Prime'),
('PRIME_2', 'amazon.com: Intento de inicio de sesión', 'string', 'Asunto 2 para emails de Amazon Prime'),
('PRIME_3', 'Amazon: Código de verificación', 'string', 'Asunto 3 para emails de Amazon Prime'),
('PRIME_4', 'Amazon: Restablecimiento de contraseña', 'string', 'Asunto 4 para emails de Amazon Prime'),
('HABILITAR_PRIME', '1', 'boolean', 'Habilitar plataforma Amazon Prime Video');

-- Spotify
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('SPOTIFY_1', 'Spotify: Código de verificación', 'string', 'Asunto 1 para emails de Spotify'),
('SPOTIFY_2', 'Spotify: Solicitud de inicio de sesión', 'string', 'Asunto 2 para emails de Spotify'),
('SPOTIFY_3', 'Spotify: Restablecimiento de contraseña', 'string', 'Asunto 3 para emails de Spotify'),
('SPOTIFY_4', 'Spotify: Cambio de contraseña', 'string', 'Asunto 4 para emails de Spotify'),
('HABILITAR_SPOTIFY', '1', 'boolean', 'Habilitar plataforma Spotify');

-- Crunchyroll
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('CRUNCHYROLL_1', 'Crunchyroll: Código de acceso', 'string', 'Asunto 1 para emails de Crunchyroll'),
('CRUNCHYROLL_2', 'Crunchyroll: Actualización de cuenta', 'string', 'Asunto 2 para emails de Crunchyroll'),
('CRUNCHYROLL_3', 'Crunchyroll: Solicitud de inicio de sesión', 'string', 'Asunto 3 para emails de Crunchyroll'),
('CRUNCHYROLL_4', 'Crunchyroll: Restablecimiento de contraseña', 'string', 'Asunto 4 para emails de Crunchyroll'),
('HABILITAR_CRUNCHYROLL', '1', 'boolean', 'Habilitar plataforma Crunchyroll');

-- Paramount+
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('PARAMOUNT_1', 'Paramount Plus: Código de acceso', 'string', 'Asunto 1 para emails de Paramount+'),
('PARAMOUNT_2', 'Paramount Plus: Actualización de cuenta', 'string', 'Asunto 2 para emails de Paramount+'),
('PARAMOUNT_3', 'Paramount Plus: Solicitud de inicio de sesión', 'string', 'Asunto 3 para emails de Paramount+'),
('PARAMOUNT_4', 'Paramount Plus: Restablecimiento de contraseña', 'string', 'Asunto 4 para emails de Paramount+'),
('HABILITAR_PARAMOUNT', '1', 'boolean', 'Habilitar plataforma Paramount+');

-- ChatGPT
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('CHATGPT_1', 'Cambio de Contraseña', 'string', 'Asunto 1 para emails de ChatGPT'),
('CHATGPT_2', 'Cambio de Correo Electrónico', 'string', 'Asunto 2 para emails de ChatGPT'),
('CHATGPT_3', 'Cambio de Nombre', 'string', 'Asunto 3 para emails de ChatGPT'),
('CHATGPT_4', 'Cambio de Cuenta', 'string', 'Asunto 4 para emails de ChatGPT'),
('HABILITAR_CHATGPT', '1', 'boolean', 'Habilitar plataforma ChatGPT');

-- Canva
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('CANVA_1', 'Canva: Código de verificación', 'string', 'Asunto 1 para emails de Canva'),
('CANVA_2', 'Canva: Solicitud de inicio de sesión', 'string', 'Asunto 2 para emails de Canva'),
('CANVA_3', 'Canva: Restablecimiento de contraseña', 'string', 'Asunto 3 para emails de Canva'),
('CANVA_4', 'Canva: Cambio de contraseña', 'string', 'Asunto 4 para emails de Canva'),
('HABILITAR_CANVA', '0', 'boolean', 'Habilitar plataforma Canva (por defecto deshabilitada)');

-- Configuraciones generales
INSERT IGNORE INTO settings (name, value, type, description) VALUES
('PAGE_TITLE', 'Consulta tu Código', 'string', 'Título de la página principal'),
('EMAIL_AUTH_ENABLED', '0', 'boolean', 'Habilitar autenticación por email');