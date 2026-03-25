<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractExtension extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'extension_type',
        'new_end_date',
        'additional_value',
        'description'
    ];

    protected $casts = [
        'new_end_date' => 'date',
        'additional_value' => 'decimal:2'
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}