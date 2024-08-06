<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductPurchase extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'purchase_items';

    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'selling_price',
        'material',
        'quantity',
        'purchasing_price',

    ];
    public function details()
    {
        return $this->hasMany(ProductPurchaseDetail::class);
    }
}
