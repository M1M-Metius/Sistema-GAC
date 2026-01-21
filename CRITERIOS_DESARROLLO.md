# GAC - Criterios Generales de Desarrollo

## 📋 Principios Fundamentales

### 1. Separación de Código y Estilo

**CRITERIO ESTRICTO:** El código HTML/PHP y los estilos CSS deben estar completamente separados.

#### Reglas:
- ✅ **PERMITIDO:**
  - Clases CSS en elementos HTML
  - IDs para JavaScript (no para estilos)
  - Variables CSS en archivos `.css`
  - Estilos en archivos `.css` separados

- ❌ **PROHIBIDO:**
  - Estilos inline (`style="..."`)
  - Etiquetas `<style>` dentro de archivos PHP/HTML
  - JavaScript que modifica estilos directamente (excepto clases)
  - Estilos en atributos HTML

#### Estructura de Archivos:
```
views/
  └── admin/
      └── dashboard/
          └── index.php          # Solo HTML/PHP, sin estilos

public/assets/css/
  └── admin/
      └── dashboard.css          # Todos los estilos aquí
```

#### Ejemplo Correcto:
```php
<!-- index.php -->
<div class="admin-container">
    <h1 class="admin-title">Dashboard</h1>
</div>
```

```css
/* dashboard.css */
.admin-container {
    padding: var(--spacing-xl);
}

.admin-title {
    font-size: var(--font-size-3xl);
    color: var(--text-primary);
}
```

#### Ejemplo Incorrecto:
```php
<!-- ❌ NO HACER ESTO -->
<div style="padding: 20px;">
    <h1 style="font-size: 2rem; color: #fff;">Dashboard</h1>
</div>
```

---

### 2. Sistema de Notificaciones y Popups

**CRITERIO ESTRICTO:** No se pueden usar alertas nativas del navegador (`alert()`, `confirm()`, `prompt()`).

#### Reglas:
- ✅ **USAR:** Sistema de modales estilizado (`window.GAC.confirm()`, `window.GAC.alert()`, etc.)
- ❌ **PROHIBIDO:** `alert()`, `confirm()`, `prompt()` nativos

#### API Disponible:
```javascript
// Alert simple
await window.GAC.alert('Mensaje', 'Título');

// Confirmación
const confirmed = await window.GAC.confirm('¿Estás seguro?', 'Confirmar');
if (confirmed) {
    // Acción
}

// Éxito
await window.GAC.success('Operación exitosa', 'Éxito');

// Advertencia
await window.GAC.warning('Cuidado', 'Advertencia');

// Error
await window.GAC.error('Algo salió mal', 'Error');
```

#### Ejemplo Correcto:
```javascript
// ✅ CORRECTO
logoutItem.addEventListener('click', async function(e) {
    e.preventDefault();
    const confirmed = await window.GAC.confirm('¿Estás seguro de cerrar sesión?', 'Cerrar Sesión');
    if (confirmed) {
        window.location.href = '/logout';
    }
});
```

#### Ejemplo Incorrecto:
```javascript
// ❌ NO HACER ESTO
if (confirm('¿Estás seguro?')) {
    // acción
}
```

---

### 3. Estructura de Carpetas

#### Organización:
- **Vistas:** `views/[seccion]/[vista].php`
- **Estilos:** `public/assets/css/[seccion]/[vista].css`
- **JavaScript:** `public/assets/js/[seccion]/[vista].js`
- **Componentes:** `public/assets/css/components/` y `public/assets/js/components/`

#### Convenciones:
- Cada vista tiene su propio archivo CSS
- Los componentes reutilizables van en `components/`
- Los estilos globales en `main.css`

---

### 4. Nomenclatura

#### Clases CSS:
- Usar nombres descriptivos y semánticos
- Prefijo según sección: `.admin-*`, `.auth-*`, `.consult-*`
- BEM opcional para componentes complejos

#### Variables CSS:
- Usar variables del sistema definidas en `main.css`
- No crear nuevas variables sin necesidad

---

### 5. Responsive Design

- Mobile-first approach
- Usar media queries en archivos CSS separados
- Probar en diferentes tamaños de pantalla

---

### 6. Accesibilidad

- Usar etiquetas semánticas HTML5
- Agregar atributos `aria-*` cuando sea necesario
- Contraste adecuado en textos
- Navegación por teclado funcional

---

### 7. Seguridad

- Escapar siempre el HTML (`htmlspecialchars()`)
- Validar y sanitizar inputs
- Usar prepared statements en SQL
- CSRF tokens en formularios

---

### 8. Performance

- Minificar CSS/JS en producción
- Optimizar imágenes
- Lazy loading cuando sea apropiado
- Cargar scripts al final del body

---

## ✅ Checklist Antes de Commit

- [ ] No hay estilos inline en HTML/PHP
- [ ] No hay alertas nativas (`alert`, `confirm`, `prompt`)
- [ ] Todos los estilos están en archivos CSS separados
- [ ] JavaScript está en archivos `.js` separados
- [ ] Código HTML escapado correctamente
- [ ] Responsive design verificado
- [ ] Sin errores de consola
- [ ] Funcionalidad probada

---

## 📝 Notas Importantes

1. **Siempre** separar código de estilo
2. **Nunca** usar alertas nativas
3. **Siempre** usar el sistema de modales para notificaciones
4. **Mantener** consistencia en la estructura de carpetas
5. **Documentar** componentes complejos

---

**Última actualización:** 2024
**Versión del sistema:** 2.0.0
