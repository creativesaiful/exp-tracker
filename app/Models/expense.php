<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'expense_amount',
        'description',
        'payment_method',
        
    ];


    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
