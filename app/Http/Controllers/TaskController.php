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
    public function index()
    {
        $tasks = DB::table('tasks')->paginate(10);
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');

        return view('task.index', compact('tasks', 'users', 'taskStatuses'));
    }

    public function create()
    {
//        $this->authorize('create', Task::class);

        $task = new Task();
//        $users = User::
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');
//        $users = DB::table('users')->get();

        return view('task.create', compact('task', 'users', 'taskStatuses'));
    }

    public function store(Request $request)
    {
//        $this->authorize('create', TaskStatus::class);

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

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
//        $url = DB::table('urls')->find($id);
//        abort_unless($task, 404);

//        $checks = DB::table('url_checks')
//            ->where('url_id', $id)
//            ->orderByDesc('created_at')
//            ->get();

        return view('task.show', compact('task'));
    }

    public function edit(Task $task)
    {
//        $this->authorize('update', $taskStatus);
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');

        return view('task.edit', compact('task', 'users', 'taskStatuses'));
    }

    public function update(Request $request, Task $task)
    {
//        $this->authorize('update', $taskStatus);
//        $taskStatus = TaskStatus::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task->fill($data);
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
//        $this->authorize('delete', $taskStatus);
//        $taskStatus = TaskStatus::find($id);
        if ($task) {
            $task->delete();
        }
        return redirect()->route('tasks.index');
    }
}
