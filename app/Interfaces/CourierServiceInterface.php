<?php

namespace App\Interfaces;

use App\DTO\ParcelData;
use App\DTO\RecipientData;
use App\DTO\DeliveryResponse;

interface CourierServiceInterface
{
    public function sendParcel(ParcelData $parcelData, RecipientData $recipientData): DeliveryResponse;
}
