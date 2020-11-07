<?php
declare(strict_types=1);

namespace App\Controller;


class capitalize implements transformInterface
{
    public function transform(string $string): string
    {
       return preg_replace('/(\w)(.)?/e', "strtoupper('$1').strtolower('$2')", $string);
    }
}