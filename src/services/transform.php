<?php
declare(strict_types=1);

namespace App\services;


interface transform
{
    public function transform(string $string): string;
}