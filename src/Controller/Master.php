<?php
declare(strict_types=1);

namespace App\Controller;



class Master
{
    /**
     * @var Logger
     */
    private $logger;
    private $transform;

    /**
     * Master constructor.
     * @param Logger $logger
     */

    public function __construct(Logger $logger, transform $transform)
    {
        $this->logger = $logger;
        $this->transform = $transform;
    }


    public function logString(string $string)
    {
        $this->logger->logger($string);
        $this->transform->transform($string);
    }
}