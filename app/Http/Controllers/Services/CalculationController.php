<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    const VALUE_DAY = 10;

    private $numberDay;

    public function calculateValueDay()
    {
        return $this->numberDay * self::VALUE_DAY;
    }

    /**
     * Get the value of numberDay
     */
    public function getNumberDay()
    {
        return $this->numberDay;
    }

    /**
     * Set the value of numberDay
     *
     * @return  self
     */
    public function setNumberDay($numberDay)
    {
        $this->numberDay = $numberDay;

        return $this;
    }
}
