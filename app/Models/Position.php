<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'admin_created_id',
        'admin_updated_id',
    ];

    /**
     * @return HasMany
     */
    public function employees()
   {
       return $this->hasMany(Employee::class);
   }
}
