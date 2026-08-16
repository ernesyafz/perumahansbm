<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cluster extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'name',
        'type',
        'price',
        'land_area',
        'building_area',
        'bedrooms',
        'bathrooms',
        'carport',
        'description',
        'feature_summary',
        'image_url',
        'image_path',
    ];

    protected $appends = ['image_src'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function getImageSrcAttribute()
    {
        if ($this->image_path) {
            return Storage::disk('public')->url($this->image_path);
        }

        return $this->image_url;
    }
}
