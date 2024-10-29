<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of all tasks and users with 'user' role.
     *
     * @return \Illuminate\View\View
     */
    public function task()
    {
        $tasks = Task::all();
        $users = User::where('role', 'user')->get(); 

        return view('admin.task.index', compact('tasks', 'users'));
    }

    /**
     * Show the form for assigning a new task to a specific user.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function assignForm(User $user)
    {
        return view('admin.task.assign', compact('user'));
    }

    /**
     * Store a newly assigned task in the database.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignTask(Request $request, User $user)
    {
        $request->validate([
            'task_title' => 'required|string',
            'priority' => 'required|string',
            'task_description' => 'required|string',
        ]);

        $task = new Task();
        $task->title = $request->input('task_title');
        $task->priority = $request->input('priority');
        $task->description = $request->input('task_description');
        $task->status = 'pending';
        $task->assigned_user_id = $user->id;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task assigned successfully');
    }
}
