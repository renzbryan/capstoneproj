<?php

namespace App\Http\Controllers;

use App\Services\FCMService;
use Illuminate\Http\Request;
use App\Models\Item;

class NotificationController extends Controller
{
    protected $fcmService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\FCMService  $fcmService
     * @return void
     */
    public function __construct(FCMService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    /**
     * Send a low stock notification to the specified device token.
     *
     * @param  string  $deviceToken
     * @param  \App\Models\Item  $product
     * @return void
     */
    public function sendLowStockNotification($deviceToken, Item $product)
    {
        $title = "Low Stock Alert";
        $body = "The product {$product->name} is running low in stock. Only {$product->stock} left!";

        // Use the FCMService to send the notification
        $this->fcmService->sendNotification($deviceToken, $title, $body);
    }
}
