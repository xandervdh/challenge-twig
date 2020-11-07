<?php
declare(strict_types=1);

namespace App\Controller;


class spaceToDashes implements transformInterface
{
    public function transform(string $string): string
    {
        return str_replace(' ', '-', $string);
    }
}