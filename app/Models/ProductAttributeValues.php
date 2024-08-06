<?php

namespace App\Models;

use Intervention\Image\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeValues extends Model
{
    use HasFactory;
    
    protected $table = 'attribute_values';
    protected $fillable = [
        'size',
        'color',
        'material'
    ];

    public function productAttribues(){
        return $this->hasMany(ProductAttributes::class);
    }
}