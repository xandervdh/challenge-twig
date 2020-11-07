<?php
declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
class logger
{
    public function loger(LoggerInterface $logger, string $string): void
    {
        $logger->info($string);
    }
}