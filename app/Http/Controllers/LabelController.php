<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Spatie\QueryBuilder\QueryBuilder;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    public function index(): View
    {
//        $labels = DB::table('labels')->orderBy('id')->paginate(10);
        $labels = QueryBuilder::for(Label::class)->orderBy('id')->paginate(10);

        return view('label.index', compact('labels'));
    }

    public function create(): View
    {
        $label = new Label();

        return view('label.create', compact('label'));
    }

    public function store(LabelRequest $request): RedirectResponse
    {
//        $data = $this->validate($request, [
//            'name' => 'required|unique:labels',
//            'description' => 'nullable'
//        ]);
        $data = $request->validated();

        $label = new Label();
        $label->fill($data)->save();

        flash(__('messages.label.create.success'))->success();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label): View
    {
        return view('label.edit', compact('label'));
    }

    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
//        $data = $this->validate($request, [
//            'name' => 'required|unique:labels,name,' . $label->id,
//            'description' => 'nullable'
//        ]);
        $data = $request->validated();

        $label->fill($data)->save();

        flash(__('messages.label.update.success'))->success();

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
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
