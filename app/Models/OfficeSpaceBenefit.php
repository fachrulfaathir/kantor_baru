<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;


class OfficeSpaceBenefit extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = ['name', 'office_space_id'];

    // Relasi: OfficeSpaceBenefit belongs to OfficeSpace
    public function officeSpace()
    {
        return $this->belongsTo(OfficeSpace::class);
    }
}
