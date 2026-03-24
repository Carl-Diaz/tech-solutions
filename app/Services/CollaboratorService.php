<?php

namespace App\Services;

use App\Models\Collaborator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class CollaboratorService
{
    public function create(array $data): Collaborator
    {
        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_type' => 'required|in:CC,CE,PPT',
            'document_number' => 'required|string|unique:collaborators',
            'birth_date' => 'required|date',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Collaborator::create($data);
    }
    public function update(int $id, array $data): Collaborator
{
    $collaborator = Collaborator::findOrFail($id);
    
    $validator = Validator::make($data, [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'document_type' => 'required|in:CC,CE,PPT',
        'document_number' => 'required|string|unique:collaborators,document_number,' . $id,
        'birth_date' => 'required|date',
        'email' => 'required|email',
        'phone_number' => 'required|string',
        'address' => 'required|string',
    ]);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }

    $collaborator->update($data);
    
    return $collaborator;
}
public function getAll(): \Illuminate\Database\Eloquent\Collection
{
    return Collaborator::all();
}
public function delete(int $id): bool
{
    $collaborator = Collaborator::findOrFail($id);
    return $collaborator->delete();
}
}