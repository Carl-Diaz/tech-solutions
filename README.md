# Tech Solutions SAS - Sistema de Gestión de Personal

Sistema backend desarrollado con **Laravel 11** utilizando **TDD (Test-Driven Development)** para la gestión de colaboradores, contratos, prórrogas y terminaciones.

## Requisitos Previos

- PHP 8.2 o superior
- Composer
- MySQL 8.0 o superior
- Git

## Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/Carl-Diaz/-tech-solutions-sas.git
cd tech-solutions-sas
```
##  Instalar dependencias
- composer install

## Configurar entorno
- cp .env.example .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tech_solutions_sas
DB_USERNAME=root
DB_PASSWORD=

## Generar clave de aplicación
- php artisan key:generate

## Ejecutar migraciones y seeders
- php artisan migrate --seed

## php artisan test
- php artisan test

## Solo pruebas de features específicos

### Colaboradores
php artisan test --filter CollaboratorTest

### Contratos
php artisan test --filter ContractTest

### Prórrogas
php artisan test --filter ContractExtensionTest

### Terminaciones
php artisan test --filter ContractTerminationTest

# Todos los features
php artisan test --filter "CollaboratorTest|ContractTest|ContractExtensionTest|ContractTerminationTest"

##  Estructura del Proyecto
tech-solutions-sas/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Collaborator.php
│   │   ├── Contract.php
│   │   ├── ContractExtension.php
│   │   └── ContractTermination.php
│   └── Services/
│       ├── CollaboratorService.php
│       ├── ContractService.php
│       ├── ContractExtensionService.php
│       └── ContractTerminationService.php
├── database/
│   ├── factories/
│   │   ├── CollaboratorFactory.php
│   │   └── ContractFactory.php
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── RoleAndUserSeeder.php
├── tests/
│   └── Feature/
│       ├── CollaboratorTest.php
│       ├── ContractTest.php
│       ├── ContractExtensionTest.php
│       └── ContractTerminationTest.php
└── docs/
    └── test-casos/
        └── CASOS_DE_PRUEBA.md

## Módulos Implementados

###  Colaboradores (5 pruebas)
- Crear colaborador
- Validar documento único
- Actualizar información
- Listar colaboradores
- Soft delete

### Contratos (4 pruebas)
- Crear contrato
- Validar colaborador existente
- Validar fechas y salario
- Actualizar contrato

### Prórrogas (3 pruebas)
- Prórroga de tiempo o valor
- No puede anadir prorroga a contrato terminado 
- Actualiza fecha fin contrato cuando se agrega prorroga de tiempo 

### Terminaciones (3 pruebas)
- Terminar contrato activo
- Registra correctamente fecha y motivo de terminacion   
- No puede terminar contrato ya terminado 

## Flujo de Trabajo con Git Flow

### Iniciar nuevo feature
git flow feature start nombre-del-feature

### Hacer cambios y commits
git add .
git commit -m "feat: descripción del cambio"

### Finalizar feature
git flow feature finish nombre-del-feature

# Subir cambios a develop
- despues de finalizar la rama, automaticamente se hace merge al la rama develop

# Documentación Adicional
- Los casos de prueba detallados están en docs/test-casos/CASOS_DE_PRUEBA.md
- Cada prueba corresponde a un caso de uso específico
- IDs de pruebas: CP-COL-001 al CP-TER-003 (15 pruebas total)

## Notas Importantes
#### TDD puro: 
Todas las funcionalidades se desarrollaron escribiendo primero las pruebas

### Relaciones
- Collaborator 1 → N Contract
- Contract N → 1 Collaborator
- Contract 1 → N ContractExtension
- Contract 1 → 1 ContractTermination

## Autor
#### Calos Alberto Diaz Sanchez
## Cargo
#### aprendiz analisis y desarrollo de software