<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function category_product()
    {
        return $this->belongsTo(Category_product::class)->withTrashed();
    }

    public function scopeFilter($query, array $filters)
    {
        return  $query->with([
            'supplier:id,name',
            'category_product:id,name'
        ])
            ->whereDate('date', '>=', $filters['start_date'])
            ->whereDate('date', '<=', $filters['end_date']);
    }
}
