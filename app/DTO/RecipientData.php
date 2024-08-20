<?php

namespace App\DTO;

class RecipientData
{
    public function __construct(
        public string $name,
        public string $phoneNumber,
        public string $email,
        public string $address
    ) {}
}
