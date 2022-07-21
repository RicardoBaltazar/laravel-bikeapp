<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentedProduct extends Model
{
    use HasFactory;

    protected $table = 'rented_products';

    protected $fillable = [
        'id',
        'customers_id',
        'product_number',
        'value',
        'number_days',
        'status'
    ];

    public function scopeDevolutionsList($query)
    {
        return $query
            ->where('rented_products.status','=', 0)
            ->get();
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class); //função customers que conecta a tabela rented_products com a referêcnia na tabela customers
    }
}
