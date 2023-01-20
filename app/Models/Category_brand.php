<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function category_brand()
    {
        return $this->belongsTo(Category_brand::class);
    }
}
