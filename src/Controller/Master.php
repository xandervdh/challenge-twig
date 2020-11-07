<?php
declare(strict_types=1);

namespace App\Controller;



class Master
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * Master constructor.
     * @param Logger $logger
     */

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }


    public function logString(string $string)
    {
        $this->logger->logger($string);
    }
}