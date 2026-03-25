<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\ContractTermination;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ContractTerminationService
{
    public function terminate(array $data): ContractTermination
    {
        $contract = Contract::findOrFail($data['contract_id']);
        
        // Validar que el contrato esté activo
        if ($contract->status !== 'Activo') {
            throw ValidationException::withMessages([
                'contract_id' => 'Solo se pueden terminar contratos activos.'
            ]);
        }

        // Validar que no tenga ya una terminación
        if ($contract->termination()->exists()) {
            throw ValidationException::withMessages([
                'contract_id' => 'Este contrato ya tiene una terminación registrada.'
            ]);
        }

        $validator = Validator::make($data, [
            'contract_id' => 'required|exists:contracts,id',
            'termination_date' => 'required|date',
            'reason' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Crear la terminación
        $termination = ContractTermination::create($data);
        
        // Actualizar estado del contrato
        $contract->status = 'Terminado';
        $contract->save();
        
        return $termination;
    }
}