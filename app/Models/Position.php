<?php

namespace App\Models;

use Database\Factories\JobPositionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    protected $guarded =[];

    // public function employee(): HasMany
    // {
    //     return $this->hasMany(Employee::class);
    // }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    protected static function newFactory()
    {
        return JobPositionFactory::new();
    }
}
