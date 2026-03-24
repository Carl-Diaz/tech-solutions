<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collaborator;
use App\Models\Contract;
use App\Services\ContractService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class ContractTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $contractService;
    private $collaborator;

    protected function setUp(): void
    {
        parent::setUp();
        
        $role = Role::create(['name' => 'Gestor RRHH']);
        $this->user = User::factory()->create([
            'email' => 'gestor@techsolutions.com'
        ]);
        $this->user->assignRole($role);
        
        $this->contractService = new ContractService();
        
        // Crear un colaborador para las pruebas
        $this->collaborator = Collaborator::factory()->create();
    }

    /** @test */
    public function puede_crear_un_contrato_asociado_a_colaborador()
    {
        $data = [
            'collaborator_id' => $this->collaborator->id,
            'contract_type' => 'Fijo',
            'start_date' => '2026-01-01',
            'end_date' => '2027-01-01',
            'position' => 'Desarrollador',
            'salary' => 3000000,
            'status' => 'Activo'
        ];

        $contract = $this->contractService->create($data);

        $this->assertInstanceOf(Contract::class, $contract);
        $this->assertDatabaseHas('contracts', [
            'collaborator_id' => $this->collaborator->id,
            'position' => 'Desarrollador'
        ]);
    }
    /** @test */
public function no_puede_crear_contrato_para_colaborador_inexistente()
{
    $data = [
        'collaborator_id' => 999, // ID que no existe
        'contract_type' => 'Fijo',
        'start_date' => '2026-01-01',
        'end_date' => '2027-01-01',
        'position' => 'Desarrollador',
        'salary' => 3000000,
        'status' => 'Activo'
    ];

    $this->expectException(ValidationException::class);
    
    $this->contractService->create($data);
}


/** @test */
public function valida_campos_de_fecha_y_salario_correctamente()
{
    $this->expectException(ValidationException::class);
    
    // Datos con errores: end_date antes que start_date y salario negativo
    $data = [
        'collaborator_id' => $this->collaborator->id,
        'contract_type' => 'Fijo',
        'start_date' => '2027-01-01',
        'end_date' => '2026-01-01',    // Fecha incorrecta (menor que start_date)
        'position' => 'Desarrollador',
        'salary' => -1000000,           // Salario negativo
        'status' => 'Activo'
    ];
    
    $this->contractService->create($data);
}
/** @test */
public function puede_actualizar_un_contrato_existente()
{
    // Crear contrato primero
    $data = [
        'collaborator_id' => $this->collaborator->id,
        'contract_type' => 'Fijo',
        'start_date' => '2026-01-01',
        'end_date' => '2027-01-01',
        'position' => 'Desarrollador',
        'salary' => 3000000,
        'status' => 'Activo'
    ];
    
    $contract = $this->contractService->create($data);
    
    // Datos actualizados
    $updatedData = [
        'collaborator_id' => $this->collaborator->id,
        'contract_type' => 'Indefinido',
        'start_date' => '2026-03-01',
        'end_date' => null,
        'position' => 'Desarrollador Senior',
        'salary' => 4500000,
        'status' => 'Activo'
    ];
    
    $updated = $this->contractService->update($contract->id, $updatedData);
    
    $this->assertEquals('Indefinido', $updated->contract_type);
    $this->assertEquals('Desarrollador Senior', $updated->position);
    $this->assertEquals(4500000, $updated->salary);
    $this->assertNull($updated->end_date);
}
}