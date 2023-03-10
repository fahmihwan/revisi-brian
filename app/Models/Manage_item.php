<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manage_item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'kelola_items';

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }

    public function kategori_brand()
    {
        return $this->belongsTo(Category_brand::class);
    }
}
