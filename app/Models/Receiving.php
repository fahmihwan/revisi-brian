<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'barang_masuks';


    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function kategori_produk()
    {
        return $this->belongsTo(Category_product::class)->withTrashed();
    }

    public function scopeFilter($query, array $filters)
    {
        return  $query->with([
            'supplier:id,nama',
            'kategori_produk:id,nama'
        ])
            ->whereDate('tanggal', '>=', $filters['start_date'])
            ->whereDate('tanggal', '<=', $filters['end_date']);
    }
}
