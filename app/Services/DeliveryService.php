<?php

namespace App\Services;

use App\DTO\ParcelData;
use App\DTO\RecipientData;
use App\Exceptions\CourierServiceException;
use App\DTO\DeliveryResponse;
use App\Services\Managers\CourierServiceManager;
use Illuminate\Support\Facades\Log;

class DeliveryService
{
    protected CourierServiceManager $courierServiceManager;

    public function __construct(CourierServiceManager $courierServiceManager)
    {
        $this->courierServiceManager = $courierServiceManager;
    }

    /**
     * Start delivery process
     *
     * @param string $courier
     * @param ParcelData $parcelData
     * @param RecipientData $recipientData
     * @return DeliveryResponse
     */
    public function processDelivery(string $courier, ParcelData $parcelData, RecipientData $recipientData): DeliveryResponse
    {
        try {
            $courierService = $this->courierServiceManager->getCourierService($courier);
            return $courierService->sendParcel($parcelData, $recipientData);
        } catch (CourierServiceException $e) {
            Log::error($e->getMessage());
            return new DeliveryResponse(success: false, message: 'Courier service error: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return new DeliveryResponse(success: false, message: 'An error occurred: ' . $e->getMessage());
        }
    }
}
