# Diagrama de Arquitectura Actual - Zona 5

## Arquitectura MVC Actual

```mermaid
graph TB
    subgraph "Frontend Layer"
        V1[Public Views]
        V2[Admin Views]
        V3[Livewire Components]
        V4[Blade Components]
    end
    
    subgraph "Controller Layer"
        C1[Public Controllers]
        C2[Admin Controllers]
        C3[Auth Controllers]
    end
    
    subgraph "Model Layer"
        M1[User Model]
        M2[Lodge Model]
        M3[News Model]
        M4[Role Model]
        M5[Position Model]
        M6[ZoneDignitary Model]
        M7[ActivityLog Model]
    end
    
    subgraph "Database Layer"
        D1[(Users Table)]
        D2[(Lodges Table)]
        D3[(News Table)]
        D4[(Roles Table)]
        D5[(Positions Table)]
        D6[(Zone Dignitaries)]
        D7[(Activity Logs)]
        D8[(Pivot Tables)]
    end
    
    V1 --> C1
    V2 --> C2
    V3 --> C2
    V4 --> V1
    V4 --> V2
    
    C1 --> M1
    C1 --> M2
    C1 --> M6
    C2 --> M1
    C2 --> M2
    C2 --> M3
    C2 --> M4
    C2 --> M5
    C2 --> M6
    C3 --> M1
    
    M1 --> D1
    M2 --> D2
    M3 --> D3
    M4 --> D4
    M5 --> D5
    M6 --> D6
    M7 --> D7
    
    M1 -.-> D8
    M2 -.-> D8
    M4 -.-> D8
    M5 -.-> D8
```

## Problemas Identificados en la Arquitectura

```mermaid
graph LR
    subgraph "Issues Críticos"
        I1[Validaciones Inconsistentes]
        I2[Manejo de Archivos Diferente]
        I3[Mensajes No Estandarizados]
        I4[Modelos Incompletos]
    end
    
    subgraph "Issues Moderados"
        I5[Componentes Duplicados]
        I6[Estilos Inconsistentes]
        I7[Patrones Livewire Diferentes]
    end
    
    subgraph "Issues Menores"
        I8[Migraciones Conflictivas]
        I9[Seeders Complejos]
        I10[Violaciones SOLID]
    end
    
    I1 --> Controllers
    I2 --> Controllers
    I3 --> Controllers
    I4 --> Models
    I5 --> Views
    I6 --> Views
    I7 --> Livewire
    I8 --> Database
    I9 --> Database
    I10 --> Architecture
```

## Arquitectura Propuesta (Mejorada)

```mermaid
graph TB
    subgraph "Presentation Layer"
        PL1[Public Views]
        PL2[Admin Views]
        PL3[Standardized Livewire Components]
        PL4[Reusable Blade Components]
    end
    
    subgraph "Application Layer"
        AL1[Form Requests]
        AL2[Controllers - Thin]
        AL3[Service Layer]
        AL4[Policies]
    end
    
    subgraph "Domain Layer"
        DL1[Models with Traits]
        DL2[Enums]
        DL3[Value Objects]
        DL4[Repository Interfaces]
    end
    
    subgraph "Infrastructure Layer"
        IL1[Eloquent Repositories]
        IL2[File Storage Service]
        IL3[Notification Service]
        IL4[Cache Service]
    end
    
    subgraph "Database Layer"
        DB1[(Normalized Tables)]
        DB2[(Optimized Indexes)]
        DB3[(Consistent Migrations)]
    end
    
    PL1 --> AL2
    PL2 --> AL2
    PL3 --> AL2
    
    AL1 --> AL2
    AL2 --> AL3
    AL3 --> DL1
    AL4 --> AL2
    
    DL1 --> DL4
    DL4 --> IL1
    DL2 --> DL1
    DL3 --> DL1
    
    IL1 --> DB1
    IL2 --> Storage
    IL3 --> Queue
    IL4 --> Cache
    
    DB1 --> DB2
    DB2 --> DB3
```

## Flujo de Datos Mejorado

```mermaid
sequenceDiagram
    participant U as User
    participant V as View
    participant C as Controller
    participant FR as Form Request
    participant S as Service
    participant R as Repository
    participant M as Model
    participant DB as Database
    
    U->>V: Interacts
    V->>C: HTTP Request
    C->>FR: Validate Data
    FR-->>C: Validated Data
    C->>S: Business Logic
    S->>R: Data Operations
    R->>M: Eloquent Operations
    M->>DB: SQL Queries
    DB-->>M: Results
    M-->>R: Model Instances
    R-->>S: Processed Data
    S-->>C: Response Data
    C-->>V: View Response
    V-->>U: Updated UI
```

## Patrones de Diseño Recomendados

```mermaid
graph TD
    subgraph "Creational Patterns"
        CP1[Factory Pattern - Model Creation]
        CP2[Builder Pattern - Query Building]
    end
    
    subgraph "Structural Patterns"
        SP1[Repository Pattern - Data Access]
        SP2[Adapter Pattern - External APIs]
        SP3[Decorator Pattern - Model Enhancement]
    end
    
    subgraph "Behavioral Patterns"
        BP1[Observer Pattern - Model Events]
        BP2[Strategy Pattern - File Upload]
        BP3[Command Pattern - Background Jobs]
    end
    
    CP1 --> Models
    CP2 --> Queries
    SP1 --> DataAccess
    SP2 --> APIs
    SP3 --> Models
    BP1 --> Events
    BP2 --> FileHandling
    BP3 --> Jobs