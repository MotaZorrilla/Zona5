# Zona5 - Portal de la Gran Logia de la República de Venezuela

[Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

---

## 1. Visión del Proyecto

Desarrollar el portal administrativo y público para la **Gran Zona 5 de la Gran Logia de la República de Venezuela**. La plataforma servirá como un punto central de información, gestión y comunicación, con un diseño moderno, profesional y vibrante.

---

## 2. Arquitectura y Decisiones Clave

### Tecnologías

*   **Backend:** Laravel 11
*   **Frontend Interactivo:** Livewire 3 / Alpine.js
*   **Estilos:** **Tailwind CSS puro**.
*   **Base de Datos:** MySQL

### Diseño y Maquetación (UI/UX)

*   **Paleta de Colores Unificada:** Azul Vibrante (`#1D4ED8`) como primario.
*   **Panel de Administración:** Diseño de dashboard completo y funcional.
*   **Sitio Público:** Diseño tipo "landing page" moderno y profesional.
*   **Consistencia de Componentes:** Se ha establecido un estilo de tarjetas unificado con efectos de realce (sombra y borde azul) que se reutiliza en todo el sitio para presentar información (Logias, Dignatarios, Noticias, etc.).

---

## 3. Plan de Desarrollo y Estado Actual

*   **Última Actualización:** 8 de Septiembre, 2025.

### Próximo Paso Inmediato (PRIORIDAD)

*   **Dinamizar el contenido del sitio público**, comenzando por el módulo de **Noticias y Eventos**. Se creará el CRUD y se conectará la vista `public/news` a datos reales.

### Resumen del Progreso

Se ha finalizado una fase crucial de **fundación y estabilización del backend**. Después de una auditoría de frontend exhaustiva, se re-priorizó el plan de trabajo para solucionar inconsistencias y funcionalidades críticas antes de proceder con nuevas características.

**Logros Clave de esta Fase:**
1.  **Lógica de Sesión Corregida:** Se implementó un menú de navegación dinámico y basado en roles para los usuarios autenticados, diferenciando claramente entre usuarios normales y administradores.
2.  **Perfil de Usuario Rediseñado:** La página de perfil de usuario (`/profile`) fue completamente rediseñada para ser visualmente consistente con el tema del panel de administración.
3.  **CRUD de Admin Funcional:** Se verificó e implementó por completo el backend para la **Gestión de Logias** y la **Gestión de Miembros/Dignatarios** en el panel de administración. Las vistas del admin ahora son dinámicas y reflejan el estado real de la base de datos.
4.  **Frontend Público Conectado:** La sección pública para visualizar una logia y sus miembros (`/lodges/{slug}`) ahora es completamente dinámica y funcional.

La base de la aplicación es ahora significativamente más robusta y coherente.

### Plan de Trabajo Unificado (Checklist)

**Leyenda:**
*   `[x]` - **Completado**
*   `[/]` - **En Progreso / Parcial** (Ej: Maquetación lista, backend pendiente)
*   `[ ]` - **Pendiente**

---

### Fase 0: Diseño y Prototipado

*   [x] Definición de la arquitectura y stack tecnológico.
*   [x] Creación y refinamiento de maqueta para el Panel de Administración.
*   [x] Creación y refinamiento de maqueta para el Sitio Público.
*   [x] Aprobación de la línea de diseño final.
*   [x] Creación de maquetas públicas para Foros y Escuela Virtual.

### Fase 1: Fundación Esencial y Backend Básico

*   **Módulo de Presencia Pública (El Escaparate)**
    *   [/] Página de Inicio (`welcome`) *(Maquetación completa)*.
    *   [/] Página "Quiénes Somos" (`about-us`) con sección de Junta Directiva interactiva *(Maquetación completa)*.
    *   [x] Listado de Logias (`lodges`) y vista de detalle (`lodge-show`) *(Backend y frontend conectados y funcionales)*.
    *   [/] Formulario de Contacto (`contact`) *(Maquetación completa)*.
    *   [x] Navegación completa y adaptativa, con lógica de roles para usuarios autenticados.
    *   [x] Integración de enlaces de Login/Registro en el layout público.
*   **Módulo de Miembros y Comunidad (El Directorio Central)**
    *   [x] Creación de modelos y migraciones para `User`, `Role`, `Lodge`.
    *   [x] CRUD completo para la gestión de Logias.
    *   [x] CRUD completo para la gestión de Usuarios.
    *   [x] Registro y Perfiles de Miembro con diseño personalizado.
    *   [/] Implementar sistema de Roles y Permisos (RBAC) *(Base funcional implementada en CRUD de usuarios)*.
    *   [/] Vista de Dignatarios en Admin (`dignitaries`) *(Funcional a través del CRUD de usuarios)*.
    *   [ ] Directorio de Miembros Privado y con Buscador.
*   **Módulo de Comunicación (El Canal Oficial)**
    *   [/] Bandeja de Entrada de Mensajes en Admin (`messages`) *(Maquetación completa)*.
    *   [ ] Sistema de Anuncios Oficiales (Planchas Digitales).
    *   [ ] Calendario Zonal Unificado de Eventos.
*   **Módulo de Gestión Documental (La Biblioteca Esencial)**
    *   [/] Repositorio de Documentos (`archive` y `admin/repository`) *(Maquetación completa)*.
*   **Módulo de Analítica e Informes (El Puente de Mando - Inicial)**
    *   [/] Dashboard Básico (`admin/dashboard`) *(Maquetación completa)*.

### Fase 2: Crecimiento y Comunidad

*   **Módulo de Comunicación y Colaboración**
    *   [/] Gestor y Vista Pública de Foros (`forums`) *(Maquetación completa)*.
    *   [ ] Mensajería Interna Segura.
*   **Módulo de Educación y Formación**
    *   [/] Gestor y Vista Pública de Escuela Virtual (`school`) *(Maquetación completa)*.
    *   [ ] Biblioteca de Trazados.
*   **Módulo de Finanzas**
    *   [/] Tesorería *(Maquetación de admin completa, backend pendiente)*

### Fase 3: Optimización y Expansión

*   **Módulo de Contenido Dinámico**
    *   [/] Vista de Noticias (`news`) *(Maquetación completa)*.
    *   [ ] Conectar vistas públicas a controladores para datos reales (Logias, Noticias, etc.).
    *   [ ] Modelos y CRUDs para `Post` (Noticias) y `Event` (Eventos).
*   **Módulo de Administración y Operaciones**
    *   [ ] Automatización y Reportes Avanzados.
*   **Módulo de Integración y Técnica**
    *   [ ] Aplicación Móvil Dedicada (Concepto a futuro).
*   **Módulo de Analítica e Informes**
    *   [ ] Dashboards Avanzados con KPIs.

---

## 4. Guía de Instalación

(Se mantiene la guía de instalación estándar de Laravel...)
