@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        Изменение статуса
    </h1>

    {{ Form::model($taskStatus, ['method' => 'PATCH', 'url' => route('task_statuses.update', $taskStatus)]) }}
    @include('task_status.form')
        {{ Form::submit('Обновить', ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
