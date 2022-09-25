@extends('layouts.app')

@section('content')
    <h1>Просмотр задачи: {{ $task->name }}</h1>

    Имя: {{ $task->name }}
<br>
    Статус: {{ $task->status->name }}
    <br>
    Описание: {{ $task->description }}
    <br>
    Метки:
@endsection
