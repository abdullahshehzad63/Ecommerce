<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'name',
        'lastname',
        'country',
        'address',
        'address_1',
        'emaiil',
        'phone_number',
        'code',
        'city',
        'state',
        'order_description'


    ];
}
