<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'date',
        'status',
        'clock_in',
        'clock_out'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
