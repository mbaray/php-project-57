@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        {{ __('labels.ViewingATask') }}: {{ $task->name }}
    </h1><br>

    <p class='font-semibold text-gray-800'> {{ __('labels.Name') }}: {{ $task->name }} </p>
    <p class='font-semibold text-gray-800'> {{ __('labels.Status') }}: {{ $task->status->name }} </p>
    <p class='font-semibold text-gray-800'> {{ __('labels.Description') }}: {{ $task->description }} </p>
    <p class='font-semibold text-gray-800'> {{ __('labels.Labels') }}:
        @foreach ($task->labels as $label)
            <span class='badge badge-pill text-bg-success'> {{ $label->name }} </span>
        @endforeach
    </p>
@endsection
