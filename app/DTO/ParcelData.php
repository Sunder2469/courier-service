<?php

namespace App\DTO;

class ParcelData
{
    public function __construct(
        public float $width,
        public float $height,
        public float $length,
        public float $weight
    ) {}
}
