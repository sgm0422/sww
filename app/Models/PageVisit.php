<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = [
        'path',
        'ip_address',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}
