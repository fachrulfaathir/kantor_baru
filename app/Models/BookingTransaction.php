<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone_number',
        'booking_trx_id',
        'is_paid',
        'started_at',
        'total_amount',
        'duration',
        'ended_at',
        'office_space_id'
    ];

    // Casting untuk kolom bertipe date
    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
        'is_paid' => 'boolean',
    ];

    // Relasi: BookingTransaction belongs to OfficeSpace
    public function officeSpace()
    {
        return $this->belongsTo(OfficeSpace::class);
    }
}