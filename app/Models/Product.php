<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id'];

    // relation to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // relation to Price
    public function price()
    {
        return $this->hasMany(Price::class);
    }

    public function latest_price()
    {
        return $this->hasOne(Price::class)->orderBy('effdate', 'desc');
    }
}
