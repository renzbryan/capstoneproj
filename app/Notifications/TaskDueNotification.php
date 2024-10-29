<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;
class TaskDueNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $task = $this->task;

        return (new MailMessage)
            ->subject('Task Due Notification')
            ->line('Dear ' . $notifiable->name . ',')
            ->line('This is to notify you that the task "' . $task->title . '" is due soon.')
            ->action('View Task', url('/tasks/' . $task->id))
            ->line('Thank you for using our application.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'message' => 'Task ' . $this->task->title . ' is due soon.',
        ];
    }

    public function sendNotification($task)
        {
            $user = $task->assignedUser;
            $user->notify(new TaskDueNotification($task));
        }
}
