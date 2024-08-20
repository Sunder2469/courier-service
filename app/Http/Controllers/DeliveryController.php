<?php

namespace App\Http\Controllers;

use App\DTO\ParcelData;
use App\DTO\RecipientData;
use App\Http\Requests\ParcelDeliveryRequest;
use App\Services\DeliveryService;
use Illuminate\Http\JsonResponse;

class DeliveryController extends Controller
{
    protected DeliveryService $deliveryService;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    /**
     * Send parcel via chosen delivery
     *
     * @param ParcelDeliveryRequest $request
     * @return JsonResponse
     */
    public function sendParcel(ParcelDeliveryRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $parcelData = new ParcelData(
            $validatedData['width'],
            $validatedData['height'],
            $validatedData['length'],
            $validatedData['weight']
        );

        $recipientData = new RecipientData(
            $validatedData['name'],
            $validatedData['phone_number'],
            $validatedData['email'],
            $validatedData['address']
        );

        $response = $this->deliveryService->processDelivery($validatedData['courier'], $parcelData, $recipientData);

        if ($response->success) {
            return response()->json([
                'message' => 'Parcel sent successfully',
                'tracking_number' => $response->trackingNumber
            ]);
        }

        return response()->json(['error' => $response->message], 500);
    }
}
