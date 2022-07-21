<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\RentedProduct;

class StatisticController extends Controller
{
    private $rentedProduct;
    private $totalValue = 0;

    public function __construct(RentedProduct $rentedProduct)
    {
        $this->rentedProduct = $rentedProduct;
    }

    public function statisticRentedProducts()
    {
        $rentedProduct = $this->rentedProduct->all();

        if ($rentedProduct->isEmpty())
        {
            return response()->json([
                'error' => 'Nenhum produto encontrado.'
            ], 404);
        }

        $totalBikes = count($rentedProduct);

        foreach ($rentedProduct as $item) {
            $this->totalValue += $item['value'];
        }

        // retornar quantas vezes cada produto foi alugado
        foreach ($rentedProduct as $item) {
            echo $item['product_number'].' - ';
        }

        return response()->json([
            'total_rented_bikes' => $totalBikes,
            'total_value' => $this->totalValue,
        ], 200);
    }
}
