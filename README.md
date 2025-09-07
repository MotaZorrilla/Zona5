# Portal Administrativo y Público - Gran Zona 5

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4F529A?style=for-the-badge&logo=livewire&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

## 1. Visión del Proyecto

Desarrollar el portal administrativo y público para la **Gran Zona 5 de la Gran Logia de la República de Venezuela**. La plataforma servirá como un punto central de información, gestión y comunicación, con un diseño moderno, profesional y vibrante.

---

## 2. Estado Actual del Proyecto

-   **Última Actualización:** 7 de Septiembre, 2025.
-   **Fase Actual:** Maquetación y Estilos Unificados (Finalizada).
-   **Logros Recientes:** 
    -   Implementada una navegación completamente adaptativa (responsive) con menú de escritorio y móvil (hamburguesa).
    -   Unificadas todas las vistas públicas con una cabecera (Hero section) consistente.
    -   Corregida y actualizada la paleta de colores del proyecto a un **Azul Vibrante** (`#1D4ED8`).
    -   Añadida una sección de Preguntas Frecuentes (FAQ) en la página de inicio.
    -   Implementada la separación de contenido público y privado, protegiendo la sección "Recursos" solo para miembros.
    -   Implementado un estilo de tarjetas unificado y consistente en todo el sitio público, con efectos hover mejorados.
    -   Corregidos los estilos de la página de inicio (`welcome.blade.php`).
    -   Ajustada la estrategia de acceso para la sección "Recursos": ahora es visible para todos, pero la interacción requiere autenticación.
    -   Corregido un error de maquetación que causaba inconsistencias en el pie de página en varias secciones públicas, unificando el diseño.
-   **Próximo Paso Inmediato (PRIORIDAD):** Iniciar el desarrollo del backend para la **Fase 2: El Repositorio de Documentos**, comenzando por los modelos y la lógica de subida de archivos.

---

## 3. Arquitectura y Decisiones Clave

### Tecnologías
-   **Backend:** Laravel 11
-   **Frontend Interactivo:** Livewire 3
-   **Estilos:** **Tailwind CSS puro**. Se decidió no utilizar librerías de componentes como DaisyUI para tener control total sobre el diseño.
-   **Base de Datos:** MySQL

### Diseño y Maquetación (UI/UX)

Tras un proceso iterativo, se ha definido la siguiente línea de diseño:

-   **Paleta de Colores Unificada:** Se usará una paleta moderna y profesional basada en tonos de **Azul Vibrante (`#1D4ED8`)** como color primario, con acentos de otros colores (verde, amarillo, rosa) para distintos elementos de la interfaz. El fondo principal será claro para dar una sensación de amplitud y limpieza.
-   **Panel de Administración:** El diseño se basa en la maqueta `V4` (`admin-preview`). Será un dashboard completo, con múltiples tarjetas de estadísticas, gráficos, feeds de actividad y menús de acceso rápido. La prioridad es la claridad, la funcionalidad y una experiencia de usuario agradable.
-   **Sitio Público:** El diseño se basa en la maqueta `V2` (`public-preview`). Será un portal moderno, tipo "landing page", enfocado en contar una historia y presentar la información de forma atractiva y profesional.

---

## 4. Roadmap del Proyecto (Plan de Trabajo)

-   **Fase 0: Diseño y Prototipado**
    -   [x] Definición de la arquitectura y stack tecnológico.
    -   [x] Creación y refinamiento de maqueta para el Panel de Administración.
    -   [x] Creación y refinamiento de maqueta para el Sitio Público.
    -   [x] Aprobación de la línea de diseño final.
    -   [x] **(Nuevo)** Creación de maquetas públicas para Foros y Escuela Virtual.

-   **Fase 1: El Núcleo del Admin.**
    -   [x] Desglosar la maqueta del admin en layouts y componentes Blade reutilizables.
    -   [x] Crear modelos y migraciones para `User`, `Role`, `Lodge`.
    -   [x] Implementar sistema de Roles y Permisos (RBAC).
    -   [x] Construir el CRUD completo para la gestión de Logias.
    -   [x] Construir el CRUD completo para la gestión de Usuarios.

-   **Fase 1.B: Implementación del Dashboard de Administración**
    -   [x] **1. Reemplazar Vista:** Sustituir el `dashboard.blade.php` por defecto con la nueva maqueta.
    -   [x] **2. Maquetación de Secciones:** Crear las vistas estáticas para todas las secciones del panel (Logias, Miembros, Repositorio, etc.).
    -   [x] **3. Navegación:** Implementar la navegación completa del panel de administración.

-   **Fase 1.C: Maquetación del Sitio Público**
    -   [x] **1. Reemplazar Vista:** Sustituir el `welcome.blade.php` por defecto con la nueva maqueta pública.
    -   [x] **2. Integrar Login:** Adaptar e integrar los enlaces de `login` y `registro` en el nuevo layout.
    -   [x] **3. Maquetación de Secciones:** Crear las vistas estáticas para las secciones públicas (Logias, Archivo, Noticias, Contacto, Foros, Escuela).
    -   [x] **4. Navegación:** Implementar la navegación completa del sitio público.
    -   [x] **5. (Nuevo)** Añadir sección de FAQ y separar contenido público/privado.

-   **Fase 2: El Repositorio de Documentos.**
    -   [ ] Crear modelo y migración para `Document` y `Category`.
    -   [ ] Implementar la lógica de subida de archivos.
    -   [ ] Construir el CRUD de Documentos con reglas de acceso.

-   **Fase 3: Construcción del Portal Público.**
    -   [ ] Conectar las vistas públicas a los controladores para mostrar datos reales (Logias, Noticias, Documentos públicos).

-   **Fase 4: Contenido Dinámico y Comunicaciones.**
    -   [ ] Modelos y CRUDs para `Post` (Noticias) y `Event` (Eventos).
    -   [ ] Implementar el blog y el calendario en el frontend.

---

## 4.1. Plan de Implementación Oficial (Checklist)

*Esta sección desglosa el plan oficial del **Informe de Implementación** y sirve como checklist para verificar que todas las funcionalidades requeridas están contempladas en el roadmap de trabajo.*

### Fase 1: Fundación Esencial
-   **Módulo 1: Presencia Pública (El Escaparate)**
    -   [ ] Gestor de Contenido (CMS) Básico para páginas ("Inicio", "Quiénes Somos", etc.).
    -   [x] Listado de Logias de la Jurisdicción *(Maquetación completa, backend pendiente)*.
    -   [x] Formulario de Contacto Seguro *(Maquetación completa, backend pendiente)*.
-   **Módulo 2: Miembros y Comunidad (El Directorio Central)**
    -   [ ] Registro y Perfiles de Miembro Básicos *(Backend pendiente)*.
    -   [ ] Directorio de Miembros Privado y con Buscador *(Vista privada para miembros post-login pendiente)*.
-   **Módulo 3: Comunicación (El Canal Oficial)**
    -   [ ] Sistema de Anuncios Oficiales (Planchas Digitales).
    -   [ ] Calendario Zonal Unificado de Eventos.
-   **Módulo 4: Gestión Documental (La Biblioteca Esencial)**
    -   [x] Repositorio de Documentos Básicos *(Maquetación completa, backend pendiente)*.
-   **Módulo 5: Analítica e Informes (El Puente de Mando - Inicial)**
    -   [x] Dashboard Básico *(Maquetación completa, backend pendiente)*.

### Fase 2: Crecimiento y Comunidad
-   [ ] **Módulo 1: Comunicación y Colaboración (Mensajería Interna Segura)**
-   [x] **Módulo 2: Administración y Operaciones (Directorio Detallado de Dignatarios)** *(Maquetación de admin completa, backend pendiente)*
-   [x] **Módulo 3: Educación y Formación (Gestor de Escuela Virtual)** *(Maquetación de admin completa, backend pendiente)*
-   [x] **Módulo 3: Educación y Formación (Vista Pública de Escuela Virtual)** *(Maquetación completa, backend pendiente)*
-   [ ] **Módulo 3: Educación y Formación (Biblioteca de Trazados)**
-   [x] **Módulo 4: Finanzas (Tesorería)** *(Maquetación de admin completa, backend pendiente)*

### Fase 3: Optimización y Expansión
-   [x] **Módulo 1: Comunicación y Colaboración (Gestor de Foros)** *(Maquetación de admin completa, backend pendiente)*
-   [x] **Módulo 1: Comunicación y Colaboración (Vista Pública de Foros)** *(Maquetación completa, backend pendiente)*
-   [ ] **Módulo 2: Administración y Operaciones (Automatización y Reportes)**
-   [ ] **Módulo 3: Integración y Técnica (Aplicación Móvil Dedicada)**
-   [ ] **Módulo 4: Analítica e Informes (Dashboards Avanzados con KPIs)**

---

## 5. Guía de Instalación

(Se mantiene la guía de instalación estándar de Laravel...)a de Instalación

(Se mantiene la guía de instalación estándar de Laravel...)