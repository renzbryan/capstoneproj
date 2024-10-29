<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;
use App\Notifications\TaskDueNotification;

class NotifyTasksDueSoon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:notify-tasks-due-soon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for tasks nearing their due date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $dueDate = Carbon::parse($task->due_date);
            $notificationDate = $dueDate->subDays($this->getNotificationThreshold($task->priority));

            if (Carbon::now()->gte($notificationDate)) {
                $this->sendNotification($task);
            }
        }
    }
    protected function getNotificationThreshold($priority)
    {
        switch ($priority) {
            case 'High':
                return 1;
            case 'Medium':
                return 3; 
            case 'Low':
                return 5; 
            default:
                return 0;
        }
    }

    protected function sendNotification($task)
    {
        $user = $task->assignedUser;

        $user->notify(new TaskDueNotification($task));
    }
}
