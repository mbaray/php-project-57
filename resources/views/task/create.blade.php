@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        {{ __('labels.CreateTask') }}
    </h1>

    {{ Form::model($task, ['route' => 'tasks.store']) }}
        @include('task.form')
        {{ Form::submit(__('labels.Create'), ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
