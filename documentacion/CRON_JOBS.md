# 🤖 Cron Jobs - Documentación Técnica

## 📋 Descripción

Sistema de cron jobs en Python para automatizar la lectura de emails desde servidores IMAP, extracción de códigos y guardado en base de datos.

---

## 🏗️ Arquitectura

```
Cron Job (email_reader.py)
    ↓
┌─────────────────────────────────────┐
│  Servicios Python                   │
├─────────────────────────────────────┤
│  - ImapService                      │
│  - EmailFilterService               │
│  - CodeExtractorService             │
└─────────────────────────────────────┘
    ↓
┌─────────────────────────────────────┐
│  Repositorios Python                │
├─────────────────────────────────────┤
│  - EmailAccountRepository           │
│  - PlatformRepository               │
│  - SettingsRepository               │
│  - CodeRepository                   │
└─────────────────────────────────────┘
    ↓
┌─────────────────────────────────────┐
│  Base de Datos                      │
├─────────────────────────────────────┤
│  - gac_operational                  │
│  - gac_warehouse                    │
└─────────────────────────────────────┘
```

---

## 📦 Componentes

### 1. `email_reader.py` (Script Principal)

**Ubicación:** `cron/email_reader.py`

**Función:** Orquesta todo el proceso de lectura y extracción.

**Flujo:**
1. Inicializa servicios
2. Obtiene cuentas IMAP habilitadas
3. Para cada cuenta:
   - Lee emails
   - Filtra por asunto
   - Extrae códigos
   - Guarda en BD
4. Actualiza estados de sincronización

### 2. `imap_service.py`

**Función:** Conecta y lee emails desde servidores IMAP.

**Características:**
- Soporte SSL/TLS
- Decodificación de headers MIME
- Extracción de cuerpo (texto y HTML)
- Manejo de emails multipart

**Métodos principales:**
- `read_account(account)` - Lee emails de una cuenta

### 3. `email_filter.py`

**Función:** Filtra emails por asunto usando patrones de settings.

**Características:**
- Carga patrones desde BD
- Comparación exacta y por similitud
- Identificación de plataforma desde asunto

**Métodos principales:**
- `filter_by_subject(emails)` - Filtra lista de emails
- `match_subject_to_platform(subject)` - Identifica plataforma

### 4. `code_extractor.py`

**Función:** Extrae códigos de emails usando regex.

**Características:**
- Patrones regex por plataforma
- Validación de formato de código
- Limpieza de código (remover espacios, guiones)

**Métodos principales:**
- `extract_code(email, platform)` - Extrae código de un email
- `identify_platform(subject)` - Identifica plataforma desde asunto

### 5. `repositories.py`

**Función:** Acceso a datos desde Python.

**Repositorios:**
- `EmailAccountRepository` - Cuentas de email
- `PlatformRepository` - Plataformas
- `SettingsRepository` - Configuraciones
- `CodeRepository` - Códigos

### 6. `database.py`

**Función:** Manejo de conexiones MySQL.

**Características:**
- Conexión singleton a BD operativa
- Conexión singleton a BD warehouse
- Cierre automático de conexiones

---

## 🔄 Flujo Completo

### 1. Inicialización

```python
# Cargar configuración
from cron.config import CRON_CONFIG

# Inicializar servicios
imap_service = ImapService()
filter_service = EmailFilterService()
extractor_service = CodeExtractorService()
```

### 2. Lectura de Cuentas

```python
accounts = EmailAccountRepository.find_by_type('imap')
```

### 3. Procesamiento por Cuenta

```python
for account in accounts:
    # Leer emails
    emails = imap_service.read_account(account)
    
    # Filtrar por asunto
    filtered = filter_service.filter_by_subject(emails)
    
    # Extraer códigos
    codes = extractor_service.extract_codes(filtered)
    
    # Guardar códigos
    for code_data in codes:
        # Validar y guardar
        CodeRepository.save(code_data)
```

### 4. Actualización de Estado

```python
EmailAccountRepository.update_sync_status(
    account_id,
    'success'  # o 'error'
)
```

---

## 📊 Integración con PHP

Los servicios Python son independientes pero complementan los servicios PHP:

| Componente | PHP | Python |
|------------|-----|--------|
| Lectura IMAP | `ImapService.php` | `imap_service.py` |
| Filtrado | `EmailFilterService.php` | `email_filter.py` |
| Extracción | `CodeExtractorService.php` | `code_extractor.py` |
| Guardado | `CodeRepository.php` | `CodeRepository` (Python) |

**Ventajas de Python para cron:**
- Mejor manejo de procesos largos
- Librerías más robustas para IMAP
- Mejor logging y manejo de errores
- No requiere servidor web

---

## ⚙️ Configuración

### Variables de Entorno

```env
# Base de Datos
DB_HOST=localhost
DB_PORT=3306
DB_NAME=gac_operational
DB_USER=root
DB_PASSWORD=password

WAREHOUSE_DB_HOST=localhost
WAREHOUSE_DB_PORT=3306
WAREHOUSE_DB_NAME=gac_warehouse
WAREHOUSE_DB_USER=root
WAREHOUSE_DB_PASSWORD=password

# Cron
CRON_ENABLED=true
CRON_EMAIL_READER_INTERVAL=5

# Logging
LOG_LEVEL=info
```

### Configuración de Cuentas

Las cuentas se configuran desde la interfaz web (PHP) y se almacenan en `email_accounts`:

```sql
INSERT INTO email_accounts (email, type, provider_config, enabled)
VALUES (
    'cuenta@dominio.com',
    'imap',
    '{
        "imap_server": "mail.dominio.com",
        "imap_port": 993,
        "imap_encryption": "ssl",
        "imap_user": "cuenta@dominio.com",
        "imap_password": "password123"
    }',
    1
);
```

---

## 🧪 Testing

### Probar Lectura Manual

```bash
cd SISTEMA_GAC
python3 cron/email_reader.py
```

### Probar Componentes Individuales

```python
# test_imap.py
from cron.imap_service import ImapService
from cron.repositories import EmailAccountRepository

account = EmailAccountRepository.find_by_type('imap')[0]
service = ImapService()
emails = service.read_account(account)
print(f"Emails leídos: {len(emails)}")
```

### Verificar Logs

```bash
tail -f logs/cron.log
```

---

## 📈 Monitoreo

### Métricas Importantes

1. **Códigos guardados por ejecución**
2. **Tiempo de ejecución**
3. **Errores de conexión IMAP**
4. **Códigos duplicados detectados**
5. **Emails procesados vs filtrados**

### Consultas Útiles

```sql
-- Últimos códigos guardados
SELECT * FROM codes 
ORDER BY created_at DESC 
LIMIT 10;

-- Estadísticas por plataforma
SELECT 
    p.display_name,
    COUNT(*) as total,
    SUM(CASE WHEN c.status = 'available' THEN 1 ELSE 0 END) as disponibles
FROM codes c
JOIN platforms p ON c.platform_id = p.id
GROUP BY p.id
ORDER BY total DESC;

-- Estado de sincronización de cuentas
SELECT 
    email,
    sync_status,
    last_sync_at,
    error_message
FROM email_accounts
WHERE enabled = 1
ORDER BY last_sync_at DESC;
```

---

## 🔧 Mantenimiento

### Limpieza de Logs

```bash
# Rotar logs (mantener últimos 30 días)
find logs/ -name "*.log" -mtime +30 -delete
```

### Verificar Conexiones

```python
from cron.database import Database

try:
    conn = Database.get_connection()
    print("✓ Conexión operativa OK")
    conn.close()
except Exception as e:
    print(f"✗ Error: {e}")
```

### Actualizar Patrones de Extracción

Los patrones se pueden actualizar desde la interfaz web o directamente en `code_extractor.py`.

---

## 🚨 Troubleshooting

### Problema: No se leen emails

**Solución:**
1. Verificar configuración IMAP en `email_accounts`
2. Probar conexión manual:
   ```python
   import imaplib
   mail = imaplib.IMAP4_SSL('mail.dominio.com', 993)
   mail.login('usuario', 'password')
   ```

### Problema: Códigos no se guardan

**Solución:**
1. Verificar que la plataforma esté habilitada
2. Verificar que no sean duplicados
3. Revisar logs para errores de BD

### Problema: Cron no se ejecuta

**Solución:**
1. Verificar permisos de ejecución: `chmod +x cron/email_reader.py`
2. Verificar ruta absoluta en crontab
3. Verificar que Python 3 esté en PATH

---

## 📚 Referencias

- **README Cron:** `cron/README.md`
- **Servicios PHP:** `IMAP_SERVICE.md`, `EMAIL_FILTER_SERVICE.md`, `CODE_EXTRACTOR_SERVICE.md`
- **Code Service:** `CODE_SERVICE.md`

---

**Última actualización:** 2024