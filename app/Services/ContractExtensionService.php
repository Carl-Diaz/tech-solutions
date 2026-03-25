<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\ContractExtension;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ContractExtensionService
{
    public function create(array $data): ContractExtension
    {
        $contract = Contract::findOrFail($data['contract_id']);
        
        // Validar que el contrato esté activo
        if ($contract->status !== 'Activo') {
            throw ValidationException::withMessages([
                'contract_id' => 'No se pueden añadir prórrogas a contratos terminados o finalizados.'
            ]);
        }

        // Validar que sea Fijo o Prestación de Servicios (no Indefinido)
        if ($contract->contract_type === 'Indefinido') {
            throw ValidationException::withMessages([
                'contract_type' => 'Los contratos indefinidos no pueden tener prórrogas.'
            ]);
        }

        // Validación personalizada
        $validator = Validator::make($data, [
            'contract_id' => 'required|exists:contracts,id',
            'extension_type' => 'required|in:Tiempo,Valor',
            'new_end_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($data, $contract) {
                    if ($data['extension_type'] === 'Tiempo' && empty($value)) {
                        $fail('La nueva fecha es obligatoria para prórrogas de tiempo.');
                    }
                    if ($data['extension_type'] === 'Tiempo' && $value <= $contract->end_date->format('Y-m-d')) {
                        $fail('La nueva fecha debe ser posterior a la fecha actual del contrato.');
                    }
                },
            ],
            'additional_value' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($data) {
                    if ($data['extension_type'] === 'Valor' && empty($value)) {
                        $fail('El valor adicional es obligatorio para prórrogas de valor.');
                    }
                },
            ],
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Crear la extensión
        $extension = ContractExtension::create($data);
        
        // Si es prórroga de tiempo, actualizar fecha del contrato
        if ($data['extension_type'] === 'Tiempo') {
            $contract->end_date = $data['new_end_date'];
            $contract->save();
        }
        
        // Si es prórroga de valor, por ahora solo creamos la extensión
        
        return $extension;
    }
}