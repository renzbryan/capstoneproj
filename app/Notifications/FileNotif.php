<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FileNotif extends Notification
{
    use Queueable;

    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = url("/download/{$this->file->id}");

        return (new MailMessage)
            ->line('A new file has been uploaded.')
            ->line("File: {$this->file->original_name}")
            ->action('Download File', $url)
            ->line('Thank you for using our file management system!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'file_id' => $this->file->id,
            'file_name' => $this->file->original_name,
            'download_link' => url("/download/{$this->file->id}"),
        ];
    }
}
