<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PetImage extends Model
{
    protected $fillable = [
        'pet_id',
        'image',
    ];

    /**
     * Get the pet that owns the image.
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * Boot the model and add event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete the image file when the model is deleted
        static::deleting(function ($petImage) {
            if ($petImage->image) {
                $imagePath = public_path($petImage->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        });
    }

    /**
     * Get the full URL for the image.
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset($this->image) : null;
    }
}
