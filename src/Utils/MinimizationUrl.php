<?php declare(strict_types=1);

namespace App\Utils;

use App\Contracts\MinimizationUrlContract;

class MinimizationUrl implements MinimizationUrlContract
{
    public function minimizing(): string
    {
        return uniqid();
    }
}
