<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Collaborator extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'first_name',
        'last_name',
        'document_type',
        'document_number',
        'birth_date',
        'email',
        'phone_number',
        'address',
    ];
}