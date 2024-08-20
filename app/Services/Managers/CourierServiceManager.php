<?php

namespace App\Services\Managers;

use App\Exceptions\CourierServiceException;
use App\Interfaces\CourierServiceInterface;

class CourierServiceManager
{
    protected array $services = [];

    public function __construct(array $services = [])
    {
        $this->services = $services;
    }

    /**
     * Register service which one to use
     * @param string $courier
     * @param CourierServiceInterface $service
     * @return void
     */
    public function registerCourierService(string $courier, CourierServiceInterface $service): void
    {
        $this->services[$courier] = $service;
    }

    /**
     * @param string $courier
     * @return CourierServiceInterface
     * @throws CourierServiceException
     */
    public function getCourierService(string $courier): CourierServiceInterface
    {
        if (!isset($this->services[$courier])) {
            throw new CourierServiceException("Courier service [{$courier}] not found.");
        }

        return $this->services[$courier];
    }
}
