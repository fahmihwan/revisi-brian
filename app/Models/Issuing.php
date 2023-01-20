<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    //tes
    public function detail_issuings()
    {
        return $this->hasMany(Detail_Issuing::class);
    }

    public function scopeFilter($query, array $filters)
    {
        return  $query->with([
            'detail_issuings.item.category_brand',
            'detail_issuings.item.category_product',
            'customer'
        ])->whereDate('date', '>=', $filters['start_date'])->whereDate('date', '<=', $filters['end_date']);
    }
}
