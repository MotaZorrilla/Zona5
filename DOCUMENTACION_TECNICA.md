# Documentación Técnica del Sistema Administrativo Gran Logia de la República de Venezuela

## 1. Descripción del Sistema

El sistema administrativo para la Gran Logia de la República de Venezuela es una plataforma web desarrollada para gestionar la información y operaciones administrativas de la organización masónica. Esta plataforma proporciona herramientas para la gestión de usuarios, logias, mensajes, noticias, archivos y otros recursos importantes.

### 1.1 Objetivo del Sistema
- Centralizar la información de los miembros y logias
- Facilitar la comunicación interna
- Gestionar contenido y archivos importantes
- Proporcionar un panel de administración robusto y seguro

### 1.2 Tecnologías Utilizadas
- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Livewire, Blade Templates, Tailwind CSS
- **Base de Datos**: SQLite (configurable a MySQL)
- **Autenticación**: Laravel Breeze
- **Arquitectura**: Patrón MVC con capas de Servicio y Repositorio

## 2. Arquitectura del Sistema

### 2.1 Capas del Sistema

El sistema sigue una arquitectura limpia dividida en las siguientes capas:

```
[Controladores HTTP] → [Capa de Servicios] → [Capa de Repositorios] → [Modelos] → [Base de Datos]
```

- **Controladores**: Gestionan las solicitudes HTTP y dependen de los servicios
- **Servicios**: Contienen la lógica de negocio y dependen de los repositorios
- **Repositorios**: Gestionan el acceso a datos y dependen de los modelos
- **Modelos**: Representan las entidades de la base de datos

### 2.2 Estructura de Directorios
```
app/
├── Console/           # Comandos de Artisan
├── Enums/            # Enumeraciones estandarizadas
├── Http/             # Controladores, Middleware, Requests
├── Models/           # Modelos Eloquent
├── Notifications/    # Notificaciones del sistema
├── Observers/        # Observadores de modelos
├── Providers/        # Proveedores de servicios
├── Services/         # Capa de servicios
├── Traits/           # Traits reutilizables
└── View/             # Componentes de vista
```

## 3. Patrones de Diseño Implementados

### 3.1 Form Requests Estandarizados

Se han implementado Form Requests para todas las operaciones de entrada de datos:

- `MessageFormRequest` - Validación para mensajes
- `RepositoryFormRequest` - Validación para repositorio de archivos
- `UserFormRequest` - Validación para usuarios
- `NewsFormRequest` - Validación para noticias
- `LodgeFormRequest` - Validación para logias

Estos Form Requests proporcionan validación centralizada, mensajes de error en español y lógica de autorización reutilizable.

### 3.2 Traits Reutilizables

#### FileUploadTrait
Proporciona métodos estandarizados para la gestión de archivos:

```php
// Almacenar archivos
$path = $this->storeFile($file, 'repository', 'public');

// Actualizar archivos (elimina el anterior automáticamente)
$path = $this->updateFile($newFile, $oldFilePath, 'repository', [], 10240, 'public');

// Eliminar archivos
$this->deleteFile($filePath, 'public');
```

#### PaginationTrait
Proporciona métodos estandarizados para la paginación:

```php
$messages = $this->paginateWithSearchAndFilters(
    $query,
    ['subject', 'content', 'sender_name'], // campos buscables
    ['status'], // campos filtrables
    $request,
    'created_at',
    'desc'
);
```

### 3.3 Enums Estándar

Se han implementado enums para estandarizar estados y roles:

- `MessageStatusEnum` - Estados de mensajes (unread, read, archived)
- `NewsStatusEnum` - Estados de noticias (draft, published, scheduled)
- `GradeLevelEnum` - Niveles grados (Aprendiz, Compañero, Maestro, Todos)
- `RoleEnum` - Roles de usuario (SuperAdmin, Admin, User)
- `StatusEnum` - Estados generales (active, inactive, pending, etc.)

## 4. Capa de Servicios

### 4.1 Implementación
Cada módulo del sistema tiene su servicio correspondiente:

- `MessageService` - Gestión de mensajes
- `RepositoryService` - Gestión de repositorio de archivos
- `UserService` - Gestión de usuarios
- `NewsService` - Gestión de noticias
- `LodgeService` - Gestión de logias

### 4.2 Ejemplo de Servicio
```php
class MessageService extends BaseService
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function sendMessage(array $data)
    {
        $messageData = [
            'sender_name' => Auth::user()->name,
            'sender_email' => Auth::user()->email,
            'subject' => $data['subject'],
            'content' => $data['content'],
            'recipient_id' => $data['recipient_id'],
            'status' => MessageStatusEnum::UNREAD,
        ];

        return $this->messageRepository->create($messageData);
    }
}
```

## 5. Capa de Repositorios

### 5.1 Implementación
Cada modelo tiene su repositorio correspondiente implementando el patrón Repository:

- `MessageRepository` - Repositorio para mensajes
- `RepositoryRepository` - Repositorio para archivos del repositorio
- `UserRepository` - Repositorio para usuarios
- `NewsRepository` - Repositorio para noticias
- `LodgeRepository` - Repositorio para logias

### 5.2 Ejemplo de Repositorio
```php
class MessageRepository extends AbstractRepository
{
    public function __construct(Message $message)
    {
        parent::__construct($message);
    }

    public function getMessagesForUser($relations = [])
    {
        $query = $this->model->newQuery();
        if (!empty($relations)) {
            $query->with($relations);
        }
        return $query->where('recipient_id', Auth::id())
            ->whereIn('status', [MessageStatusEnum::UNREAD, MessageStatusEnum::READ])
            ->get();
    }
}
```

## 6. Controladores

Todos los controladores siguen la estructura estándar:

```php
class MessageController extends Controller
{
    use PaginationTrait;

    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(Request $request)
    {
        // Implementación del controlador
    }
}
```

## 7. Validaciones y Seguridad

### 7.1 Validaciones Uniformes
Las validaciones se centralizan en los Form Requests:

```php
class MessageFormRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'recipient_id' => 'required|exists:users,id|different:' . Auth::id(),
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }
}
```

### 7.2 Autorización
Se implementa autorización basada en roles a través de middleware y controladores:

- SuperAdmin: Acceso completo
- Admin: Acceso a la mayoría de las funciones
- User: Acceso limitado

## 8. Pruebas Unitarias

### 8.1 Cobertura de Pruebas
- **49 pruebas unitarias** implementadas y pasando
- Pruebas para todos los modelos
- Pruebas para servicios y repositorios
- Pruebas para traits
- Pruebas para enums

### 8.2 Ejemplo de Prueba
```php
class MessageServiceTest extends TestCase
{
    public function test_send_message()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $inputData = [
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => 2,
        ];

        $this->messageRepository
            ->shouldReceive('create')
            ->with($expectedData)
            ->andReturn(new Message($expectedData));

        $result = $this->messageService->sendMessage($inputData);
        
        $this->assertInstanceOf(Message::class, $result);
    }
}
```

## 9. Configuración del Sistema

### 9.1 Requisitos
- PHP 8.2+
- Composer
- SQLite o MySQL
- Web server (Apache/Nginx)

### 9.2 Instalación
```bash
# Clonar el repositorio
git clone <repository-url>

# Instalar dependencias
composer install
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Migrar base de datos
php artisan migrate --seed

# Iniciar servidor
php artisan serve
```

## 10. Consideraciones de Seguridad

- Autenticación JWT o por sesión
- Validación de entradas en Form Requests
- Autorización basada en roles
- Sanitización de entradas
- Protección CSRF
- Gestión segura de archivos

## 11. Mantenimiento y Escalabilidad

### 11.1 Principios Aplicados
- Separación de responsabilidades (SoC)
- Principio de inversión de dependencias (DIP)
- Open/Closed Principle (OCP)
- Don't Repeat Yourself (DRY)

### 11.2 Escalabilidad
- Arquitectura modular
- Capas claramente definidas
- Configuración flexible
- Pruebas automatizadas

## 12. Convenios de Codificación

### 12.1 Estándares
- PSR-12 para estilo de código
- Nomenclatura en español para lógica de negocio
- Nomenclatura en inglés para código técnico
- Comentarios en español
- Documentación en español

### 12.2 Estructura de Nombres
- Clases: PascalCase
- Métodos: camelCase
- Variables: camelCase
- Constantes: UPPER_SNAKE_CASE
- Archivos: kebab-case

## 13. Módulos del Sistema

### 13.1 Mensajes
- Sistema de mensajería interna
- Buzón de entrada, archivados y eliminados
- Marcado como leído/no leído
- Búsqueda y filtrado

### 13.2 Usuarios
- Gestión de perfiles de usuario
- Roles y permisos
- Asociación con logias

### 13.3 Logias
- Información de logias
- Historia y detalles
- Gestión de miembros

### 13.4 Repositorio
- Subida y organización de documentos
- Categorización por grado
- Control de acceso

### 13.5 Noticias
- Publicación de noticias
- Estados de publicación
- Calendario de publicación

## 14. Consideraciones Especiales

### 14.1 Estandarización Masonica
- Uso del color oro (#D4AF37) como color principal
- Paleta de colores que refleja la identidad masónica
- Lenguaje y terminología apropiada

### 14.2 Internacionalización
- Soporte para español como idioma principal
- Preparado para futura internacionalización
- Mensajes y validaciones en español

## 15. Futuras Mejoras

- Implementación de WebSocket para notificaciones en tiempo real
- Sistema de backup automatizado
- API RESTful para integración móvil
- Dashboard con estadísticas y métricas
- Sistema de logs de auditoría
- Integración con sistemas externos
- Optimización de rendimiento

## 16. Documentación de APIs

Toda la funcionalidad REST está documentada a través de:
- Form Requests con validación
- Controladores con lógica clara
- Servicios con lógica de negocio
- Comentarios PHPDoc en todas las clases

## 17. Control de Versiones

Sistema implementado con Git y siguiendo prácticas de control de versiones:
- Uso de ramas feature para nuevas funcionalidades
- Convención de commits en español
- Etiquetas de versiones para releases

---

**Fecha de última actualización**: Septiembre 2025
**Versión del Documento**: 1.0
**Desarrollado por**: Equipo de Desarrollo Gran Logia de la República de Venezuela