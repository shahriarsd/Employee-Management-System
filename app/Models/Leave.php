<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    protected $fillable = ['employee_id', 'from_date', 'to_date', 'reason', 'status'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
