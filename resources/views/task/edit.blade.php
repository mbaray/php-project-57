@extends('layouts.app')

@section('content')
    <h1>Создать задачу</h1>

    {{ Form::model($task, ['method' => 'PATCH', 'url' => route('tasks.update', $task)]) }}
        @include('task.form')
        {{ Form::submit('Обновить') }}
    {{ Form::close() }}
@endsection
