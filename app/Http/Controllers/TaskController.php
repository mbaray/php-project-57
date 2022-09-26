<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index()
    {
        $tasks = DB::table('tasks')->paginate(10);
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');

        return view('task.index', compact('tasks', 'users', 'taskStatuses'));
    }

    public function create()
    {
        $task = new Task();
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');

        return view('task.create', compact('task', 'users', 'taskStatuses'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task = new Task();
        $task->fill($data);
        $task->creator()->associate(Auth::user());
        $task->save();
        flash(__('messages.task.create.success'))->success();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');

        return view('task.edit', compact('task', 'users', 'taskStatuses'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task->fill($data);
        $task->save();
        flash(__('messages.task.update.success'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task) {
            $task->delete();
            flash(__('messages.task.delete.success'))->success();
        } else {
            flash(__('messages.task.delete.fail'))->error();
        }

        return redirect()->route('tasks.index');
    }
}
