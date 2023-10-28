<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    use HasFactory;
    protected $fillable = [
        "expense_amount",
        'user_id',
        'category_id',
        'description',
        'payment_method',
        
    ];
}
