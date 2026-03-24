<?php

namespace App\Services;

use App\Models\Contract;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ContractService
{
    public function create(array $data): Contract
    {
        $validator = Validator::make($data, [
            'collaborator_id' => 'required|exists:collaborators,id',
            'contract_type' => 'required|in:Fijo,Indefinido,Prestación de Servicios',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'status' => 'required|in:Activo,Terminado,Finalizado'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Contract::create($data);
    }
    public function update(int $id, array $data): Contract
{
    $contract = Contract::findOrFail($id);
    
    $validator = Validator::make($data, [
        'collaborator_id' => 'required|exists:collaborators,id',
        'contract_type' => 'required|in:Fijo,Indefinido,Prestación de Servicios',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after:start_date',
        'position' => 'required|string|max:255',
        'salary' => 'required|numeric|min:0',
        'status' => 'required|in:Activo,Terminado,Finalizado'
    ]);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }

    $contract->update($data);
    
    return $contract;
}
}