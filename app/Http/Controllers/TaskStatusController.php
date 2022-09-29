<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status');
    }

    public function index(): View
    {
//        $taskStatuses = DB::table('task_statuses')->orderBy('id')->paginate(10);
        $taskStatuses = QueryBuilder::for(TaskStatus::class)
            ->orderBy('id')
            ->paginate(10);

        return view('task_status.index', compact('taskStatuses'));
    }

    public function create(): View
    {
        $taskStatus = new TaskStatus();

        return view('task_status.create', compact('taskStatus'));
    }

    public function store(TaskStatusRequest $request): RedirectResponse
    {
//        $data = $this->validate($request, [
//            'name' => 'required|unique:task_statuses',
//        ]);
        $data = $request->validated();

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data)->save();

        flash(__('messages.task_status.create.success'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): View
    {
        return view('task_status.edit', compact('taskStatus'));
    }

    public function update(TaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
//        $data = $this->validate($request, [
//            'name' => 'required|unique:task_statuses,name,' . $taskStatus->id,
//        ]);
        $data = $request->validated();

        $taskStatus->fill($data)->save();

        flash(__('messages.task_status.update.success'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->tasks->isEmpty()) {
            $taskStatus->delete();
            flash(__('messages.task_status.delete.success'))->success();
        } else {
            flash(__('messages.task_status.delete.fail'))->error();
        }
        return redirect()->route('task_statuses.index');
    }
}
