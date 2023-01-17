<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
        'preview',
        'created_at',
        'updated_at',
        'admin_created_id',
        'admin_updated_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function photoUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['photo'])
        );
    }

    public function previewUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url($this->attributes['preview'])
        );
    }
}
