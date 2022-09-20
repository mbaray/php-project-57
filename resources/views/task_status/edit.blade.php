@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

{{--    {{ Form::model($taskStatus, ['route' => ['task_statuses.update', $taskStatus], 'method' => 'PATCH']) }}--}}
    {{ Form::model($taskStatus, ['method' => 'PATCH', 'url' => route('task_statuses.update', $taskStatus)]) }}
    @include('task_status.form')
        {{ Form::submit('Обновить') }}
    {{ Form::close() }}
@endsection
