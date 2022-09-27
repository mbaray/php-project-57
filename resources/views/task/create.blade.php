@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        Создать задачу
    </h1>

    {{ Form::model($task, ['route' => 'tasks.store']) }}
        @include('task.form')
        {{ Form::submit('Создать', ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
