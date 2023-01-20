<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'kategori_brands';

    // public function items()
    public function items()
    {
        return $this->hasMany(Item::class, 'kategori_brand_id');
    }

    // public function kategori_brand()
    // {
    //     return $this->belongsTo(Category_brand::class);
    // }
}
