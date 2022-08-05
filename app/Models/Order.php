<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'subsidiary_id',
    ];

    public function client(): belongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function subsidiary(): belongsTo
    {
        return $this->belongsTo(Subsidiary::class);
    }
}
