<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
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

    public function index(Request $request)
    {
        $filters = $request->input('filter');
//        return $filters;

//        $tasks = DB::table('tasks')
////            ->where('status_id', $filters['status_id'])
////            ->where('created_by_id', $filters['created_by_id'])
////            ->where('assigned_to_id', $filters['assigned_to_id'])
//            ->orderBy('id')
//            ->paginate(10);


        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->orderBy('id')
            ->paginate(10);
//        return $filters;

        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');

        return view('task.index', compact('tasks', 'users', 'taskStatuses', 'filters'));
    }

    public function create()
    {
        $task = new Task();
        $users = User::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        return view('task.create', compact('task', 'users', 'taskStatuses', 'labels'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

//        return $request->label_id;
//        return var_dump(!isset($request->label_id[0]));
        $task = new Task();

        $task->fill($data)
            ->creator()
            ->associate(Auth::user())
            ->save();

        if (isset($request->labels[0])) {
            $task->labels()->attach($request->labels);
//            return $task->labels;
        }

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
        $labels = Label::pluck('name', 'id');

        return view('task.edit', compact('task', 'users', 'taskStatuses', 'labels'));
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

        $task->labels()->detach();
        if (isset($request->labels[0])) {
            $task->labels()->attach($request->labels);
        }

        flash(__('messages.task.update.success'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
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
