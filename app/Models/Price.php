<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'effdate', 'product_id'];

    // relation to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


