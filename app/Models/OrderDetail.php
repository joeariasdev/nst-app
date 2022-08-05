<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    const INSPECTION = 'inspection';
    const DIAGNOSIS = 'diagnosis';
    const RECOVERY = 'recovery';
    const COMPLETE = 'complete';

    protected $fillable = [
        'order_id',
        'device_id',
        'status',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
