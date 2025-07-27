<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str; // Import the Str facade
use Laravel\Sanctum\HasApiTokens;



class OfficeSpace extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name',
        'thumbnail',
        'address',
        'is_open',
        'is_full_book',
        'price',
        'duration',
        'about',
        'city_id',
        'slug'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Relasi: OfficeSpace belongs to City
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relasi: OfficeSpace memiliki banyak OfficeSpacePhoto
    public function photos()
    {
        return $this->hasMany(OfficeSpacePhoto::class);
    }

    // Relasi: OfficeSpace memiliki banyak OfficeSpaceBenefit
    public function benefits()
    {
        return $this->hasMany(OfficeSpaceBenefit::class);
    }

    // Relasi: OfficeSpace memiliki banyak BookingTransaction
    public function bookingTransactions()
    {
        return $this->hasMany(BookingTransaction::class);
    }
}