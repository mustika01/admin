<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WorkProfile extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function user(): HasOne
    {
        return $this->HasOne(User::class);
    }
}
