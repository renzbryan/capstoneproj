<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class TaskOverdueNotif extends Notification
{
    use Queueable;

    protected $task;
    protected $priority;

    public function __construct(Task $task, $priority)
    {
        $this->task = $task;
        $this->priority = $priority;
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

    public function toMail($notifiable)
    {
        $dueDate = $this->calculateDueDate();

        return (new MailMessage)
            ->subject('Task Overdue Notification')
            ->line('Dear ' . $notifiable->name . ',')
            ->line('This is to notify you that the task "' . $this->task->title . '" is overdue.')
            ->line('Priority: ' . ucfirst($this->priority))
            ->line('Original Due Date: ' . $this->task->due_date->toDateString())
            ->line('Current Date: ' . Carbon::now()->toDateString())
            ->line('The task should have been completed by ' . $dueDate->toDateString() . '.')
            ->action('View Task', url('/tasks/' . $this->task->id))
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
            //
        ];
    }
    protected function calculateDueDate()
    {
        switch ($this->priority) {
            case 'high':
                return $this->task->due_date->addDays(1); 
            case 'medium':
                return $this->task->due_date->addDays(3); 
            case 'low':
                return $this->task->due_date->addDays(5); 
            default:
                return $this->task->due_date->addDays(3); 
        }
    }
}
