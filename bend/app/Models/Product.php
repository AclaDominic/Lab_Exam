<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'stock', 
        'image'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')->withPivot('quantity');
    }
    
    // Prevent product deletion if it has been ordered
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            if ($product->orders()->exists()) {
                abort(400,"Product cannot be deleted because it is already ordered.");
            }
        });
    }
}
