<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = DB::table('task_statuses')->paginate(10);

        return view('task_status.index', compact('taskStatuses'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();

        return view('task_status.create', compact('taskStatus'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses',
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        return redirect()->route('task_statuses.index');
    }

    public function show(TaskStatus $taskStatus)
    {
        //
    }

    public function edit(int $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);

        return view('task_status.edit', compact('taskStatus'));
    }

    public function update(Request $request, int $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name,' . $taskStatus->id,
        ]);

        $taskStatus->fill($data);
        $taskStatus->save();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(int $id)
    {
        $taskStatus = TaskStatus::find($id);
        if ($taskStatus) {
            $taskStatus->delete();
        }
        return redirect()->route('task_statuses.index');
    }
}
