@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        Просмотр задачи: {{ $task->name }}
    </h1><br>

    <p class='font-semibold text-gray-800'> Имя: {{ $task->name }} </p>
    <p class='font-semibold text-gray-800'> Статус: {{ $task->status->name }} </p>
    <p class='font-semibold text-gray-800'> Описание: {{ $task->description }} </p>
    <p class='font-semibold text-gray-800'> Метки:
        @foreach ($task->labels as $label)
            <span class="badge badge-pill text-bg-success"> {{ $label->name }} </span>
        @endforeach
    </p>
@endsection
