<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_id',
        'name',
        'employment_at',
        'phone',
        'email',
        'salary',
        'photo',
        'created_at',
        'updated_at',
        'admin_created_id',
        'admin_updated_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
