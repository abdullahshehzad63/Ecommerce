<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;
    protected $table = 'products_attributes';
    protected $fillable = [
        'size',
        'product_id',
        'color',
        'material',
        'price',
        'purchasing_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductAttributeValues::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductAttributeValues::class, 'color_id');
    }

    public function material()
    {
        return $this->belongsTo(ProductAttributeValues::class, 'material');
    }
}
