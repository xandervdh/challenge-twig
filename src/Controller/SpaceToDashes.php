<?php
declare(strict_types=1);

namespace App\Controller;

use App\services\transform;

class SpaceToDashes implements transform
{
    public function transform(string $string): string
    {
        return str_replace(' ', '-', $string);
    }
}