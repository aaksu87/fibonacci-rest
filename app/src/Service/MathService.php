<?php

namespace App\Service;

use App\Contracts\FibonacciInterface;

class MathService implements FibonacciInterface
{
    /**
     * @param int $n
     * @return float
     */
    public function getNumber(int $n) : float
    {
        $phi = (1 + sqrt(5)) / 2;
        return round(pow($phi, $n) / sqrt(5));

        //basic solution was that, but it returns "execution time" error with big numbers
        /*
        if ($n <= 1)
            return $n;
        else
            return (
                $this->getNumber($n - 1) +
                $this->getNumber($n - 2)
            );*/
    }
}