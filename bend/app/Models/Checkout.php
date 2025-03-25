<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    
    protected $fillable = ['employee_id', 'order_id', 'checked_out_at'];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    // Scope for filtering checkouts by date
    public function scopeFilterByDate($query, $startDate, $endDate)
    {
        return $query->whereBetween('checked_out_at', [$startDate, $endDate]);
    }
}