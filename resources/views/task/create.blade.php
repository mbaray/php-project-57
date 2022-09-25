@extends('layouts.app')

@section('content')
    <h1>Создать задачу</h1>

    {{ Form::model($task, ['route' => 'tasks.store']) }}
        @include('task.form')
    {{ Form::submit('Создать') }}
    {{ Form::close() }}
@endsection
