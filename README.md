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

*   Iniciar el desarrollo del backend para la **Fase 2: El Repositorio de Documentos**, comenzando por los modelos y la lógica de subida de archivos.

### Resumen del Progreso

Se ha finalizado por completo la fase de diseño y maquetación estática tanto para el sitio público como para el panel de administración. Todas las vistas principales y secciones han sido construidas con un estilo visual unificado y adaptativo (responsive), incluyendo componentes interactivos con Alpine.js (modales). La base visual para la implementación del backend está completa y es sólida.

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

### Fase 1: Fundación Esencial y Maquetación

*   **Módulo de Presencia Pública (El Escaparate)**
    *   [/] Página de Inicio (`welcome`) *(Maquetación completa)*.
    *   [/] Página "Quiénes Somos" (`about-us`) con sección de Junta Directiva interactiva *(Maquetación completa)*.
    *   [/] Listado de Logias (`lodges`) con enlace a vista de detalle *(Maquetación completa)*.
    *   [/] Vista de detalle de Dignatarios de Logia (`lodge-dignitaries-show`) con modales interactivos *(Maquetación completa)*.
    *   [/] Formulario de Contacto (`contact`) *(Maquetación completa)*.
    *   [/] Navegación completa y adaptativa para ambos sitios (público y admin) *(Maquetación completa)*.
    *   [/] Integración de enlaces de Login/Registro en el layout público *(Maquetación completa)*.
*   **Módulo de Miembros y Comunidad (El Directorio Central)**
    *   [x] Creación de modelos y migraciones para `User`, `Role`, `Lodge`.
    *   [/] Vista de Dignatarios en Admin (`dignitaries`) *(Maquetación completa)*.
    *   [ ] Implementar sistema de Roles y Permisos (RBAC).
    *   [ ] CRUD completo para la gestión de Logias.
    *   [ ] CRUD completo para la gestión de Usuarios.
    *   [ ] Registro y Perfiles de Miembro Básicos.
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
