<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\CalculationController;
use App\Http\Requests\RentedProductRequest;
use App\Models\Customers;
use App\Models\RentedProduct;
use Illuminate\Http\Request;

class RentedProductController extends Controller
{
    private $rentedProduct;
    private $customers;
    private $calculation;
    private $value;
    private $daysOfDelay = 0;
    private $lateFine = 0;

    const FINE_PER_DAY = 5;

    public function __construct(RentedProduct $rentedProduct,
        CalculationController $calculation, Customers $customers) {
        $this->rentedProduct = $rentedProduct;
        $this->customers = $customers;
        $this->calculation = $calculation;
    }

    public function index()
    {
        $rentedProduct = $this->rentedProduct->paginate('5');

        return response()->json($rentedProduct, 200);
    }

    public function store(RentedProductRequest $request)
    {
        $rentedProduct = $request->all();

        try {
            $this->calculation->setNumberDay($rentedProduct['number_days']);
            $this->value = $this->calculation->calculateValueDay();
            $rentedProduct['value'] = $this->value;

            $dataCustomer = $this->customers->create($rentedProduct);
            $rentedProduct['customers_id'] = $dataCustomer['id'];

            if (empty($rentedProduct['customers_id'])) {
                return response()->json('Não foi possível achar id do cliente', 401);
            }

            $dataRentedProduct = $this->rentedProduct->create($rentedProduct);

            return response()->json([
                'message' => 'produto alugado com sucesso',
                'product' => $dataRentedProduct,
            ], 200);

        } catch (\Exception $error) {
            $message = new ApiMessages($error->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function devolution(Request $request)
    {
        $devolution = $request->all();

        try {
            $rentedProduct = $this->rentedProduct->find($devolution['id']);

            $this->daysOfDelay = $this->lateDaysCalculation($devolution['number_days'], $rentedProduct['number_days']);

            $this->lateFine = $rentedProduct['value'] += $this->daysOfDelay * self::FINE_PER_DAY;

            $rentedProduct->update(
                [
                    'value' => $this->lateFine,
                    'status' => 0,
                ]
            );

            return response()->json($rentedProduct, 200);

        } catch (\Exception $error) {
            $message = new ApiMessages($error->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function devolutionsList()
    {
        $devolutionsList = $this->rentedProduct->devolutionsList();

        return response()->json($devolutionsList, 200);
    }

    public function destroy($id)
    {
        try {
            $dataRentedProduct = $this->rentedProduct->findOrFail($id);
            $customerId = $dataRentedProduct['customers_id'];
            $dataCustomer = $this->customers->find($customerId);
            $dataRentedProduct->delete();
            $dataCustomer->delete();

            return response()->json('Produto removido com sucesso', 200);

        } catch (\Exception $error) {
            $message = new ApiMessages($error->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    private function lateDaysCalculation($devolutionDays, $rentedDays)
    {
        if ($devolutionDays < $rentedDays) {
            return response()->json('Os dias de atraso não podem ser menores que os dias alugados', 401);
        }

        return $devolutionDays - $rentedDays;
    }
}
