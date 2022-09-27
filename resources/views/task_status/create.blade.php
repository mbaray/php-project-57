@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        Создать статус
    </h1>
    {{ Form::model($taskStatus, ['route' => 'task_statuses.store']) }}
        @include('task_status.form')
        {{ Form::submit('Создать', ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
