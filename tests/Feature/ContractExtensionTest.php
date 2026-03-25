<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collaborator;
use App\Models\Contract;
use App\Models\ContractExtension;
use App\Services\ContractExtensionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class ContractExtensionTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $extensionService;
    private $contract;

    protected function setUp(): void
    {
        parent::setUp();

        $role = Role::create(['name' => 'Gestor RRHH']);
        $this->user = User::factory()->create([
            'email' => 'gestor@techsolutions.com'
        ]);
        $this->user->assignRole($role);

        $this->extensionService = new ContractExtensionService();

        // Crear colaborador y contrato para las pruebas
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
    public function puede_anadir_prorroga_de_tiempo_o_valor_a_contrato_fijo()
    {
        // PRÓRROGA DE TIEMPO
        $dataTiempo = [
            'contract_id' => $this->contract->id,
            'extension_type' => 'Tiempo',
            'new_end_date' => '2027-06-30',
            'additional_value' => null,
            'description' => 'Prórroga por 6 meses adicionales'
        ];

        $extensionTiempo = $this->extensionService->create($dataTiempo);

        $this->assertInstanceOf(ContractExtension::class, $extensionTiempo);
        $this->assertDatabaseHas('contract_extensions', [
            'contract_id' => $this->contract->id,
            'extension_type' => 'Tiempo',
            'new_end_date' => '2027-06-30'
        ]);

        $this->contract->refresh();
        $this->assertEquals('2027-06-30', $this->contract->end_date->format('Y-m-d'));

        // PRÓRROGA DE VALOR (nuevo contrato para esta prueba)
        $nuevoContrato = Contract::factory()->create([
            'collaborator_id' => $this->contract->collaborator_id,
            'contract_type' => 'Fijo',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'status' => 'Activo'
        ]);

        $dataValor = [
            'contract_id' => $nuevoContrato->id,
            'extension_type' => 'Valor',
            'new_end_date' => null,
            'additional_value' => 2000000,
            'description' => 'Adición presupuestal'
        ];

        $extensionValor = $this->extensionService->create($dataValor);

        $this->assertInstanceOf(ContractExtension::class, $extensionValor);
        $this->assertDatabaseHas('contract_extensions', [
            'contract_id' => $nuevoContrato->id,
            'extension_type' => 'Valor',
            'additional_value' => 2000000
        ]);

        $nuevoContrato->refresh();
        $this->assertEquals('2026-12-31', $nuevoContrato->end_date->format('Y-m-d'));
    }
    
    
    /** @test */
    public function actualiza_fecha_fin_contrato_cuando_se_agrega_prorroga_de_tiempo()
    {
        // Fecha original del contrato
        $fecha_original = $this->contract->end_date->format('Y-m-d');

        $data = [
            'contract_id' => $this->contract->id,
            'extension_type' => 'Tiempo',
            'new_end_date' => '2027-06-30',
            'additional_value' => null,
            'description' => 'Prórroga por 6 meses adicionales'
        ];

        $this->extensionService->create($data);

        // Verificar que la fecha del contrato se actualizó
        $this->contract->refresh();
        $this->assertEquals('2027-06-30', $this->contract->end_date->format('Y-m-d'));
        $this->assertNotEquals($fecha_original, $this->contract->end_date->format('Y-m-d'));
    }
    /** @test */
    public function no_puede_anadir_prorroga_a_contrato_terminado()
    {
        // Cambiar el estado del contrato a Terminado
        $this->contract->status = 'Terminado';
        $this->contract->save();

        $data = [
            'contract_id' => $this->contract->id,
            'extension_type' => 'Tiempo',
            'new_end_date' => '2027-06-30',
            'additional_value' => null,
            'description' => 'Prórroga por 6 meses adicionales'
        ];

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('No se pueden añadir prórrogas a contratos terminados o finalizados.');

        $this->extensionService->create($data);
    }
}
