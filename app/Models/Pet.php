<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'full_name',
        'call_name',
        'sire_name',
        'dam_name',
        'owner_name',
        'breeder_name',
        'reg_no',
        'sex',
        'birthdate',
        'color',
        'status',
        'category',
        'available_status',
        'is_reserved',
        'is_featured_dog',
        'slug',
        'OFA',
        'ref_link',
        'description',
        'primaryImg',
        'image',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'image' => 'array',
        'is_reserved' => 'boolean',
        'is_featured_dog' => 'boolean',
    ];

    /**
     * Get the color that owns the pet.
     */
    public function petColor()
    {
        return $this->belongsTo(PetColor::class, 'color');
    }

    /**
     * Get the images for the pet.
     */
    public function petImages()
    {
        return $this->hasMany(PetImage::class);
    }

    /**
     * Get the color name attribute.
     */
    public function getColorNameAttribute()
    {
        return $this->petColor?->color_name ?? $this->color;
    }

    /**
     * Boot the model and add event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete all pet images when the pet is deleted
        static::deleting(function ($pet) {
            $pet->petImages()->each(function ($image) {
                $image->delete();
            });
        });
    }
}
