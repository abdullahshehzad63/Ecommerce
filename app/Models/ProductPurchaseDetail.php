<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchaseDetail extends Model
{
    use HasFactory;
    protected $table = 'product_purchase_details';
    use HasFactory;

    protected $fillable = [
        'product_purchase_id',
        'product_id',
        'selling_price',
        'purchasing_price',
        'quantity',
        'total_price',
    ];

    public function productPurchase()
    {
        return $this->belongsTo(ProductPurchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
