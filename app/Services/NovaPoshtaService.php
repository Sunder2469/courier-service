<?php

namespace App\Services;

use App\DTO\ParcelData;
use App\DTO\RecipientData;
use App\DTO\DeliveryResponse;
use App\Exceptions\CourierServiceException;
use App\Interfaces\CourierServiceInterface;
use Illuminate\Support\Facades\Http;

class NovaPoshtaService implements CourierServiceInterface
{
    protected string $apiUrl;
    protected string $senderAddress;

    public function __construct()
    {
        $this->apiUrl = config('delivery-services.novaposhta.api_url');
        $this->senderAddress = config('delivery-services.novaposhta.sender_address');
    }

    /**
     * Send parcel via NovaPoshta requirements
     *
     * @param ParcelData $parcelData
     * @param RecipientData $recipientData
     * @return DeliveryResponse
     * @throws CourierServiceException
     */
    public function sendParcel(ParcelData $parcelData, RecipientData $recipientData): DeliveryResponse
    {
        $response = Http::post($this->apiUrl, [
            'customer_name'    => $recipientData->name,
            'phone_number'     => $recipientData->phoneNumber,
            'email'            => $recipientData->email,
            'sender_address'   => $this->senderAddress,
            'delivery_address' => $recipientData->address,
        ]);

        if ($response->failed()) {
            throw new CourierServiceException('Nova Poshta service failed: ' . $response->body());
        }

        $responseData = $response->json();

        return new DeliveryResponse(
            success: true,
            trackingNumber: $responseData['tracking_number'] ?? null,
            message: $responseData['message'] ?? null
        );
    }
}
