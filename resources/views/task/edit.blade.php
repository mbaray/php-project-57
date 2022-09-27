@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        Изменение задачи
    </h1>

    {{ Form::model($task, ['method' => 'PATCH', 'url' => route('tasks.update', $task)]) }}
        @include('task.form')
        {{ Form::submit('Обновить', ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
