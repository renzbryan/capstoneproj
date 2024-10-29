<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\BfarOffice;
use App\Models\Iar;

class UserTaskController extends Controller
{
    /**
     * Display tasks assigned to the authenticated user that are not yet completed.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('assigned_user_id', $user->id)
                     ->where('status', '!=', 'done')
                     ->paginate(3); // Paginate the results with 3 tasks per page
        
        return view('admin.usertask.index', compact('tasks'));
    }

    /**
     * Handle task based on the type and show appropriate view.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @param string $type
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function doTask(Request $request, Task $task, $type)
    {
        $taskId=$task->id;

        switch ($type) {
            case 'IAR':
                    $iars = Iar::get();
                    $model = new BfarOffice();
                    $officeOptions = $model->getOptions();
            
                    return view('admin.iar.create-iar', compact('iars', 'officeOptions','taskId'));
            case 'Stock':
                // Handle Stock task
                break;
            case 'Property':
                // Handle Property task
                break;
            case 'RLSDDSP':
                // Handle RLSDDSP task
                break;
            case 'WMR':
                // Handle WMR task
                break;
            case 'RIS':
                // Handle RIS task
                break;
            case 'RFCI':
                // Handle RFCI task
                break;
            case 'ICS':
                // Handle ICS task
                break;
            case 'RSMI':
                // Handle RSMI task
                break;
            case 'RAAF':
                // Handle RAAF task
                break;
            case 'SPC':
                // Handle SPC task
                break;
            case 'RSPI':
                // Handle RSPI task
                break;
            case 'RegSPI':
                // Handle RegSPI task
                break;
            case 'ITR':
                // Handle ITR task
                break;
            case 'IIRUP/SEMI':
                // Handle IIRUP/SEMI task
                break;
            case 'PAR':
                // Handle PAR task
                break;
            case 'RCPPE':
                // Handle RCPPE task
                break;
            case 'PTR':
                // Handle PTR task
                break;
            case 'IIRUP/PPE':
                // Handle IIRUP/PPE task
                break;
            case 'RLSDDP':
                // Handle RLSDDP task
                break;
            case 'RETURNED/PPE':
                // Handle RETURNED/PPE task
                break;
            default:
                // Default case if type is not recognized
                break;
        }

        // Mark task as done
        $task->status = 'done';
        $task->save();

        return redirect()->route('usertasks.index')->with('success', 'Task marked as done successfully.');
    }
}