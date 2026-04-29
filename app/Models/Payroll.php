<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    protected $fillable = ['employee_id', 'basic_salary', 'bonus', 'deduction', 'month'];

    protected $appends = ['net_salary'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getNetSalaryAttribute(): float
    {
        return $this->basic_salary + $this->bonus - $this->deduction;
    }
}
