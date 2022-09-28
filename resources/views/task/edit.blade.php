@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        {{ __('labels.EditTask') }}
    </h1>

    {{ Form::model($task, ['method' => 'PATCH', 'url' => route('tasks.update', $task)]) }}
        @include('task.form')
        {{ Form::submit(__('labels.Update'), ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
