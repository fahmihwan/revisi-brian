<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'barang_keluars';

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function detail_barang_keluars()
    {
        return $this->hasMany(Detail_Issuing::class, 'barang_keluar_id');
    }

    public function scopeFilter($query, array $filters)
    {
        return  $query->with([
            'detail_barang_keluars.item.kategori_brand',
            'detail_barang_keluars.item.kategori_produk',
            'customer'
        ])->whereDate('tanggal', '>=', $filters['start_date'])->whereDate('tanggal', '<=', $filters['end_date']);
    }
}
