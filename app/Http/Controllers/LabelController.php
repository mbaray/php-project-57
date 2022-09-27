<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    public function index()
    {
        $labels = DB::table('labels')->paginate(10);

        return view('label.index', compact('labels'));
    }

    public function create()
    {
        $label = new Label();

        return view('label.create', compact('label'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:labels',
        ]);

        $label = new Label();
        $label->fill($data)->save();

        flash(__('messages.label.create.success'))->success();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:labels,name,' . $label->id,
        ]);

        $label->fill($data)->save();

        flash(__('messages.label.update.success'))->success();

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        if ($label->tasks->isEmpty()) {
            $label->delete();
            flash(__('messages.label.delete.success'))->success();
        } else {
            flash(__('messages.label.delete.fail'))->error();
        }
        return redirect()->route('labels.index');
    }
}
