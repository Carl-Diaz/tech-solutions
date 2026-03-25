<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collaborator;
use App\Models\Contract;
use App\Models\ContractTermination;
use App\Services\ContractTerminationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class ContractTerminationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $terminationService;
    private $contract;

    protected function setUp(): void
    {
        parent::setUp();
        
        $role = Role::create(['name' => 'Gestor RRHH']);
        $this->user = User::factory()->create([
            'email' => 'gestor@techsolutions.com'
        ]);
        $this->user->assignRole($role);
        
        $this->terminationService = new ContractTerminationService();
        
        // Crear colaborador y contrato activo para las pruebas
        $collaborator = Collaborator::factory()->create();
        $this->contract = Contract::factory()->create([
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'status' => 'Activo'
        ]);
    }

    /** @test */
    public function puede_terminar_contrato_activo()
    {
        $data = [
            'contract_id' => $this->contract->id,
            'termination_date' => '2026-06-30',
            'reason' => 'Renuncia voluntaria del colaborador'
        ];

        $termination = $this->terminationService->terminate($data);

        $this->assertInstanceOf(ContractTermination::class, $termination);
        $this->assertDatabaseHas('contract_terminations', [
            'contract_id' => $this->contract->id,
            'termination_date' => '2026-06-30',
            'reason' => 'Renuncia voluntaria del colaborador'
        ]);
        
        // Verificar que el contrato cambió su estado a Terminado
        $this->contract->refresh();
        $this->assertEquals('Terminado', $this->contract->status);
    }

    /** @test */
    /** @test */
public function registra_correctamente_fecha_y_motivo_de_terminacion()
{
    $data = [
        'contract_id' => $this->contract->id,
        'termination_date' => '2026-06-30',
        'reason' => 'Renuncia voluntaria del colaborador'
    ];

    $termination = $this->terminationService->terminate($data);

    $this->assertDatabaseHas('contract_terminations', [
        'contract_id' => $this->contract->id,
        'termination_date' => '2026-06-30',
        'reason' => 'Renuncia voluntaria del colaborador'
    ]);
}

/** @test */
public function no_puede_terminar_contrato_ya_terminado()
{
    $data = [
        'contract_id' => $this->contract->id,
        'termination_date' => '2026-06-30',
        'reason' => 'Renuncia voluntaria del colaborador'
    ];
    
    $this->terminationService->terminate($data);
    
    $this->expectException(ValidationException::class);
    $this->expectExceptionMessage('Solo se pueden terminar contratos activos.');
    
    $this->terminationService->terminate($data);
}
}