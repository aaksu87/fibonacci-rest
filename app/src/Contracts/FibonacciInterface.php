<?php

namespace App\Contracts;

interface FibonacciInterface
{
    public function getNumber(int $n) : float;
}