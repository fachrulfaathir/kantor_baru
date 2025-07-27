<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str; // Import the Str facade
use Laravel\Sanctum\HasApiTokens;


class City extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = ['name', 'photo', 'slug'];

    // Relasi: City memiliki banyak OfficeSpace
    public function officeSpaces()
    {
        return $this->hasMany(OfficeSpace::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}