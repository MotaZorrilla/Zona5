# Portal Administrativo y Público - Gran Zona 5

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4F529A?style=for-the-badge&logo=livewire&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

## 1. Visión del Proyecto

Desarrollar el portal administrativo y público para la **Gran Zona 5 de la Gran Logia de la República de Venezuela**. La plataforma servirá como un punto central de información, gestión y comunicación, con un diseño moderno, profesional y vibrante.

---

## 2. Estado Actual del Proyecto

-   **Última Actualización:** 3 de Septiembre, 2025.
-   **Fase Actual:** Finalizada la **Fase 1: El Núcleo del Admin**.
-   **Logros Recientes:** Se ha desglosado la maqueta del admin, creado modelos y migraciones, implementado RBAC y construido los CRUDs para Logias y Usuarios.

### Próximo Paso Inmediato

-   **Acción:** Comenzar la **Fase 2: El Repositorio de Documentos**.
-   **Tarea Específica:** Crear el modelo y la migración para `Document` y `Category`.

---

## 3. Arquitectura y Decisiones Clave

### Tecnologías
-   **Backend:** Laravel 11
-   **Frontend Interactivo:** Livewire 3
-   **Estilos:** **Tailwind CSS puro**. Se decidió no utilizar librerías de componentes como DaisyUI para tener control total sobre el diseño.
-   **Base de Datos:** MySQL

### Diseño y Maquetación (UI/UX)

Tras un proceso iterativo, se ha definido la siguiente línea de diseño:

-   **Paleta de Colores Unificada:** Se usará una paleta moderna y vibrante basada en tonos **Índigo** como color primario, con acentos de otros colores (verde, amarillo, rosa) para distintos elementos de la interfaz. El fondo principal será claro para dar una sensación de amplitud y limpieza.
-   **Panel de Administración:** El diseño se basa en la maqueta `V4` (`admin-preview`). Será un dashboard completo, con múltiples tarjetas de estadísticas, gráficos, feeds de actividad y menús de acceso rápido. La prioridad es la claridad, la funcionalidad y una experiencia de usuario agradable.
-   **Sitio Público:** El diseño se basa en la maqueta `V2` (`public-preview`). Será un portal moderno, tipo "landing page", enfocado en contar una historia y presentar la información de forma atractiva y profesional.

---

## 4. Roadmap del Proyecto (Plan de Trabajo)

-   **Fase 0: Diseño y Prototipado**
    -   [x] Definición de la arquitectura y stack tecnológico.
    -   [x] Creación y refinamiento de maqueta para el Panel de Administración.
    -   [x] Creación y refinamiento de maqueta para el Sitio Público.
    -   [x] Aprobación de la línea de diseño final.

-   **Fase 1: El Núcleo del Admin.**
    -   [x] Desglosar la maqueta del admin en layouts y componentes Blade reutilizables.
    -   [x] Crear modelos y migraciones para `User`, `Role`, `Lodge`.
    -   [x] Implementar sistema de Roles y Permisos (RBAC).
    -   [x] Construir el CRUD completo para la gestión de Logias.
    -   [x] Construir el CRUD completo para la gestión de Usuarios.

-   **Fase 2: El Repositorio de Documentos.**
    -   [ ] Crear modelo y migración para `Document` y `Category`.
    -   [ ] Implementar la lógica de subida de archivos.
    -   [ ] Construir el CRUD de Documentos con reglas de acceso.

-   **Fase 3: Construcción del Portal Público.**
    -   [ ] Desglosar la maqueta pública en layouts y componentes Blade.
    -   [ ] Conectar las vistas públicas a los controladores para mostrar datos reales (Logias, Noticias, Documentos públicos).

-   **Fase 4: Contenido Dinámico y Comunicaciones.**
    -   [ ] Modelos y CRUDs para `Post` (Noticias) y `Event` (Eventos).
    -   [ ] Implementar el blog y el calendario en el frontend.

---

## 5. Guía de Instalación

(Se mantiene la guía de instalación estándar de Laravel...)