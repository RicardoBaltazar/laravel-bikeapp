<?php

namespace Tests\Feature;

use App\Http\Controllers\Services\CalculationController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculationTest extends TestCase
{
    /**
     * @dataProvider valueProvider
     */
    public function test_calculate_value_day_is_correct($value, $expectedValue){

        $calculation = new CalculationController();

        $calculation->setNumberDay(2);
        $this->assertEquals($expectedValue, $calculation->calculateValueDay($value));
    }

    public function valueProvider(){
        return [
            'test_calculate_value_day_is_correct' => ['value' => 2, 'expectedValue' => '20']
        ];
    }
}
