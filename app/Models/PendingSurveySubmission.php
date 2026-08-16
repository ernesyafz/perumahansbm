<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingSurveySubmission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'token',
        'payload',
        'created_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'created_at' => 'datetime',
    ];
}
