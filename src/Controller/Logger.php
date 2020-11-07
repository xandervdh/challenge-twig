<?php
declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Logger constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logger(string $string): void
    {
        $this->logger->info($string, [Loglevel::INFO]);
    }
}