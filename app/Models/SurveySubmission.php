<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveySubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'submitted_at',
        'verified_at',
        'name',
        'email',
        'phone',
        'address',
        'preferred_schedule',
        'notes',
        'status',
        'admin_note',
        'scheduled_at',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'verified_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
