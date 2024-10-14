<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;
    // Disable auto-incrementing for UUIDs
    public $incrementing = false;

    // Set the key type to string since we're using UUIDs
    protected $keyType = 'string';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name', 
        'category', 
        'active_ingredients', 
        'batch_number', 
        'research_status', 
        'manufacturing_date', 
        'expiration_date'
    ];

    // Automatically generate a UUID for new products
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
