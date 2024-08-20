<?php

namespace App\DTO;

class DeliveryResponse
{
    public function __construct(
        public bool $success,
        public ?string $trackingNumber = null,
        public ?string $message = null
    ) {}
}
