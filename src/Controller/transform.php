<?php
declare(strict_types=1);

namespace App\Controller;


interface transform
{
    public function transform(string $string): string;
}