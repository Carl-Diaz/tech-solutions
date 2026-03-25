<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractTermination extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'termination_date',
        'reason'
    ];

    protected $casts = [
        'termination_date' => 'date'
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}