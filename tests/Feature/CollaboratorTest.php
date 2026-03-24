<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collaborator;
use App\Services\CollaboratorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class CollaboratorTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $collaboratorService;

    protected function setUp(): void
    {
        parent::setUp();
        
        $role = Role::create(['name' => 'Gestor RRHH']);
        $this->user = User::factory()->create([
            'email' => 'gestor@techsolutions.com'
        ]);
        $this->user->assignRole($role);
        
        $this->collaboratorService = new CollaboratorService();
    }

    /** @test */
    public function puede_crear_un_colaborador_con_datos_validos()
    {
        $data = [
            'first_name' => 'Juan',
            'last_name' => 'Pérez',
            'document_type' => 'CC',
            'document_number' => '123456789',
            'birth_date' => '1990-01-01',
            'email' => 'juan.perez@example.com',
            'phone_number' => '3001234567',
            'address' => 'Calle 123 #45-67',
        ];

        $collaborator = $this->collaboratorService->create($data);

        $this->assertInstanceOf(Collaborator::class, $collaborator);
        $this->assertDatabaseHas('collaborators', [
            'document_number' => '123456789',
            'email' => 'juan.perez@example.com',
        ]);
    }

    /** @test */
public function no_puede_crear_colaborador_con_documento_duplicado()
{
    $data = [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'document_type' => 'CC',
        'document_number' => '123456789',
        'birth_date' => '1990-01-01',
        'email' => 'juan.perez@example.com',
        'phone_number' => '3001234567',
        'address' => 'Calle 123 #45-67',
    ];

    // Crear primer colaborador
    $this->collaboratorService->create($data);

    // Intentar crear otro con el mismo documento
    $this->expectException(ValidationException::class);
    
    $this->collaboratorService->create($data);
}
/** @test */
public function puede_actualizar_un_colaborador_existente()
{
    // Crear colaborador primero
    $data = [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'document_type' => 'CC',
        'document_number' => '123456789',
        'birth_date' => '1990-01-01',
        'email' => 'juan.perez@example.com',
        'phone_number' => '3001234567',
        'address' => 'Calle 123 #45-67',
    ];
    
    $collaborator = $this->collaboratorService->create($data);
    
    // Datos actualizados
    $updatedData = [
        'first_name' => 'Juan Carlos',
        'last_name' => 'Pérez Gómez',
        'document_type' => 'CC',
        'document_number' => '123456789', // Mismo documento
        'birth_date' => '1990-01-01',
        'email' => 'juancarlos.perez@example.com',
        'phone_number' => '3009876543',
        'address' => 'Carrera 45 #67-89',
    ];
    
    // Necesitamos agregar método update al service
    $updated = $this->collaboratorService->update($collaborator->id, $updatedData);
    
    $this->assertEquals('Juan Carlos', $updated->first_name);
    $this->assertEquals('juancarlos.perez@example.com', $updated->email);
    $this->assertDatabaseHas('collaborators', [
        'id' => $collaborator->id,
        'email' => 'juancarlos.perez@example.com'
    ]);
}
/** @test */
public function puede_obtener_listado_de_colaboradores()
{
    // Crear varios colaboradores
    $data1 = [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'document_type' => 'CC',
        'document_number' => '111111',
        'birth_date' => '1990-01-01',
        'email' => 'juan@example.com',
        'phone_number' => '300111',
        'address' => 'Calle 1',
    ];
    
    $data2 = [
        'first_name' => 'María',
        'last_name' => 'Gómez',
        'document_type' => 'CC',
        'document_number' => '222222',
        'birth_date' => '1991-02-02',
        'email' => 'maria@example.com',
        'phone_number' => '300222',
        'address' => 'Calle 2',
    ];
    
    $this->collaboratorService->create($data1);
    $this->collaboratorService->create($data2);
    
    // Necesitamos agregar método getAll al service
    $collaborators = $this->collaboratorService->getAll();
    
    $this->assertCount(2, $collaborators);
    $this->assertEquals('Juan', $collaborators->first()->first_name);
}
/** @test */
public function puede_eliminar_un_colaborador()
{
    // Crear colaborador
    $data = [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'document_type' => 'CC',
        'document_number' => '123456789',
        'birth_date' => '1990-01-01',
        'email' => 'juan.perez@example.com',
        'phone_number' => '3001234567',
        'address' => 'Calle 123 #45-67',
    ];
    
    $collaborator = $this->collaboratorService->create($data);
    
    // Eliminar (soft delete)
    $this->collaboratorService->delete($collaborator->id);
    
    // Verificar que está en la BD pero con deleted_at no nulo
    $this->assertSoftDeleted('collaborators', [
        'id' => $collaborator->id
    ]);
}
}