<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;


class ApiKey extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = ['name', 'key'];
}