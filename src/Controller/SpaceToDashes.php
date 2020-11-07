<?php
declare(strict_types=1);

namespace App\Controller;


class SpaceToDashes implements transformInterface
{
    public function transform(string $string): string
    {
        return str_replace(' ', '-', $string);
    }
}