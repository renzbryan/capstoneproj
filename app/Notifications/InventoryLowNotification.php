<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InventoryLowNotification extends Notification
{
    use Queueable;
    protected $inventoryItem;
    /**
     * Create a new notification instance.
     */
    public function __construct($inventoryItem)
    {
        $this->inventoryItem = $inventoryItem;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The inventory for ' . $this->inventoryItem->name . ' is low.')
                    ->line('Current quantity: ' . $this->inventoryItem->quantity)
                    ->action('Restock Item', url('/inventory/' . $this->inventoryItem->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'item_id' => $this->inventoryItem->id,
            'quantity' => $this->inventoryItem->quantity,
        ];
    }
}
