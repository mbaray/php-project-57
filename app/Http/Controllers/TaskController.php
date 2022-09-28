<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(Request $request): View
    {
        $filters = $request->input('filter');
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->orderBy('id')
            ->paginate(10);

        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');

        return view('task.index', compact('tasks', 'users', 'taskStatuses', 'filters'));
    }

    public function create(): View
    {
        $task = new Task();
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        return view('task.create', compact('task', 'users', 'taskStatuses', 'labels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task = new Task();
        $task->fill($data)
            ->creator()
            ->associate(Auth::user())
            ->save();

        if (isset($request->labels[0])) {
            $task->labels()->attach($request->labels);
        }

        flash(__('messages.task.create.success'))->success();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        return view('task.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        return view('task.edit', compact('task', 'users', 'taskStatuses', 'labels'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task->fill($data);
        $task->save();

        $task->labels()->detach();
        if (isset($request->labels[0])) {
            $task->labels()->attach($request->labels);
        }

        flash(__('messages.task.update.success'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        if ($task) {
            $task->labels()->detach();
            $task->delete();
            flash(__('messages.task.delete.success'))->success();
        } else {
            flash(__('messages.task.delete.fail'))->error();
        }

        return redirect()->route('tasks.index');
    }
}
