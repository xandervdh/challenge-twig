<?php
declare(strict_types=1);

namespace App\services;



use App\Controller\Logger;

class Master
{
    /**
     * @var Logger
     * @var transform
     */
    private $logger;
    private $transform;

    /**
     * Master constructor.
     * @param Logger $logger
     * @param transform $transform
     */

    public function __construct(Logger $logger, transform $transform)
    {
        $this->logger = $logger;
        $this->transform = $transform;
    }


    public function logString(string $string)
    {
        $this->logger->logger($string);
        return $this->transform->transform($string);
    }
}