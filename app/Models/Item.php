<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function kategori_brand()
    {
        return $this->belongsTo(Category_brand::class)->withTrashed();
    }

    public function kategori_produk()
    {
        return $this->belongsTo(Category_product::class)->withTrashed();
    }

    public function items()
    {
        return $this->belongsToManys(Item::class);
    }
}
