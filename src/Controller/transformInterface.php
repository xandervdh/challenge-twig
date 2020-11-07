<?php
declare(strict_types=1);

namespace App\Controller;


interface transformInterface
{
    public function transform(string $string): string;
}