@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        {{ __('labels.CreateStatus') }}
    </h1>
    {{ Form::model($taskStatus, ['route' => 'task_statuses.store']) }}
        @include('task_status.form')
        {{ Form::submit(__('labels.Create'), ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
