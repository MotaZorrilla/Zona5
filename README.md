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

*   **Última Actualización:** 11 de Septiembre, 2025.

### Próximo Paso Inmediato (PRIORIDAD)

*   **CORREGIDO: Reparada la funcionalidad de ordenamiento y búsqueda en la tabla de Venerables Maestros.** Se refactorizó el componente Livewire `ManageVenerableMasters` para optimizar la consulta a la base de datos, utilizando `joins` para permitir el ordenamiento por columnas de tablas relacionadas (logia y número de logia) y simplificando la lógica de búsqueda. Se corrigieron varios errores de JavaScript y de sintaxis PHP que impedían que la funcionalidad operara correctamente.

### Resumen del Progreso

Se ha finalizado una fase crucial de **fundación y estabilización del backend**. Después de una auditoría de frontend exhaustiva, se re-priorizó el plan de trabajo para solucionar inconsistencias y funcionalidades críticas antes de proceder con nuevas características.

**Logros Clave de esta Fase:**
1.  **Funcionalidad de Ordenamiento y Búsqueda Reparada en Venerables Maestros:** Se ha reparado y optimizado por completo la funcionalidad de ordenamiento y búsqueda en la tabla de Venerables Maestros. Se refactorizó la consulta del componente Livewire para usar `JOINs` de base de datos, permitiendo un ordenamiento eficiente por nombre, nombre de logia y número de logia. La lógica de búsqueda ahora también es más rápida y precisa. Se corrigieron una serie de errores de JavaScript y PHP que impedían el correcto funcionamiento.
1.  **Mejoras Adicionales en Venerables Maestros:** Se ha corregido la funcionalidad de ordenamiento por nombre, logia y número de logia en la tabla de Venerables Maestros. Además, se ha ajustado el título de la columna "Número de Logia" a "Número" para mayor concisión.
1.  **Funcionalidad de Edición de Venerables Maestros:** Se ha implementado un modal de edición en el componente Livewire de Venerables Maestros. Este modal permite actualizar los detalles de un Venerable Maestro (nombre, teléfono) y, crucialmente, cambiar el Venerable Maestro de una logia, asignando un nuevo miembro y actualizando la posición del anterior.
1.  **Mejoras de UI/UX en Venerables Maestros:** Se ha refactorizado la tabla de "Venerables Maestros por Logia" a un componente Livewire, aplicando estilos visuales consistentes con el resto del panel de administración (colores, filas alternas, etc.). Se ha implementado la funcionalidad de ordenamiento por nombre y logia, y se muestra el número de logia junto al nombre, mejorando la usabilidad y presentación de los datos.
1.  **Refactorización de Seeders:** Se ha realizado una refactorización completa de los seeders de la base de datos para eliminar conflictos y duplicados. Se eliminó el `UserSeeder` general y se consolidó la creación de todos los miembros, incluyendo los Venerables Maestros, dentro del seeder específico de cada logia. Esto asegura una única fuente de verdad para los datos de los miembros y mejora la integridad de la información.
1.  **Corrección en Consulta de Dignatarios:** Se ha reparado y optimizado la consulta Eloquent en `ZoneDignitaryController` que obtiene los Venerables Maestros. La consulta anterior era incorrecta y no devolvía resultados, lo que impedía que la tabla se mostrara. La nueva consulta es más eficiente y funcional, asegurando que los datos se muestren correctamente.
1.  **Consistencia de UI en Dignatarios:** Se ha rediseñado la página de "Directorio de Dignatarios" para alinearla con el estilo visual del resto del panel de administración. Se unificó el layout, se eliminaron los contenedores de ancho limitado y se consolidó la información en una única tarjeta principal, mejorando la coherencia de la experiencia de usuario.
1.  **Estandarización de Seeders:** Se han auditado y corregido todos los seeders de la base de datos para eliminar la generación de correos electrónicos ficticios, asegurando que se asigne `null` cuando no se proporciona un email. Esto mejora la calidad y consistencia de los datos de prueba y previene posibles conflictos.
1.  **Población de Datos Completada:** Se ha integrado y poblado la base de datos con la información completa de los miembros de la logia "Domingo Faustino Sarmiento N° 167", finalizando la carga inicial de datos de las logias de la jurisdicción.
1.  **Lógica de Sesión Corregida:** Se implementó un menú de navegación dinámico y basado en roles para los usuarios autenticados, diferenciando claramente entre usuarios normales y administradores.
2.  **Perfil de Usuario Rediseñado:** La página de perfil de usuario (`/profile`) fue completamente rediseñada para ser visualmente consistente con el tema del panel de administración.
3.  **CRUD de Admin Funcional:** Se verificó e implementó por completo el backend para la **Gestión de Logias** y la **Gestión de Miembros/Dignatarios** en el panel de administración. Las vistas del admin ahora son dinámicas y reflejan el estado real de la base de datos.
4.  **Frontend Público Conectado:** La sección pública para visualizar una logia y sus miembros (`/lodges/{slug}`) ahora es completamente dinámica y funcional.
5.  **Dashboard Dinámico:** Los indicadores clave (KPIs) para Miembros y Logias, así como el listado de "Miembros por Logia", ahora son dinámicos y muestran datos reales de la base de datos.
6.  **Sistema de Actividad:** Se ha implementado un sistema de registro de actividad (`ActivityLog`) para rastrear eventos clave. El primer evento integrado es el registro de nuevos usuarios, que ya se muestra en el feed de "Actividad Reciente" del dashboard.
7.  **Consistencia de UI en Gestión:** Se han unificado los estilos de los botones y filtros en la sección de "Gestión de Miembros" para una experiencia de usuario más coherente y profesional.
8.  **Mejoras en la Tabla de Miembros:** Se ha enriquecido la tabla de gestión de miembros añadiendo la columna "Grado" y mejorando el filtro de logias para mostrar su número, facilitando la identificación y el ordenamiento de los usuarios.
9.  **Estandarización de Datos:** Se ha corregido y estandarizado el almacenamiento del grado de los miembros en la base de datos, asegurando que se guarde como "Maestro" en lugar de "Maestro Masón" para mantener la consistencia y prevenir errores.
10. **Mejora Visual en Gestión de Miembros:** Se ha rediseñado la tabla de miembros y sus elementos de control con una paleta de colores más rica y funcional. Esto incluye una cabecera de tabla con el color primario, filas alternadas, distintivos de color para los grados, y una paginación, buscador y filtros estilizados para una experiencia de usuario más coherente y atractiva.
11. **Consistencia Visual del CRUD de Miembros:** Se ha extendido el nuevo lenguaje de diseño a todas las vistas relacionadas con la gestión de miembros (Crear, Editar y Mostrar), asegurando una experiencia de usuario unificada, profesional y visualmente atractiva en todo el módulo.

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
    *   [x] Página "Quiénes Somos" (`about-us`) con sección de Junta Directiva interactiva *(Backend y frontend conectados y funcionales, diseño de tarjetas de miembros actualizado y optimizado)*.
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
    *   [x] Dashboard Básico (`admin/dashboard`) *(KPIs, widgets y feed de actividad funcionales)*.
        *   **Mejoras Recientes:**
            *   Reordenamiento de tarjetas de estadísticas (Logias Activas, Aprendices, Compañeros, Maestros, Miembros, Mensajes Nuevos).
            *   Ajuste de la etiqueta "Maestros Masones" a "Maestros" en las tarjetas y en la lógica de conteo por grado.
            *   Dinamización de tarjetas de grado (Aprendices, Compañeros, Maestros) para mostrar conteos reales.
            *   Cambio de "Miembros Totales" a "Miembros" en la tarjeta principal.
            *   Adición de un indicador de diferencia en la tarjeta "Miembros", mostrando el número de usuarios sin un grado específico asignado.
            *   Alineación de los tres gráficos principales (Distribución por Grado, Crecimiento de Miembros, Crecimiento de Contenido) en una sola fila para una visualización más compacta.
            *   Ajuste de la leyenda del gráfico "Distribución por Grado" a la izquierda para optimizar el espacio.
            *   Centrado vertical de los gráficos de "Crecimiento de Miembros" y "Crecimiento de Contenido" dentro de sus tarjetas, manteniendo sus títulos alineados en la parte superior.
            *   Ajuste del tamaño del gráfico "Distribución por Grado" para asegurar consistencia visual con los otros gráficos, haciéndolo ligeramente más grande que el tamaño inicial reducido.
    *   [/] Sistema de Registro de Actividad (`ActivityLog`) *(Base implementada, registrando creación de usuarios)*.

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
