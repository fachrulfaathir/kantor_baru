<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;


class OfficeSpacePhoto extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = ['photo', 'office_space_id'];

    // Relasi: OfficeSpacePhoto belongs to OfficeSpace
    public function officeSpace()
    {
        return $this->belongsTo(OfficeSpace::class);
    }
}