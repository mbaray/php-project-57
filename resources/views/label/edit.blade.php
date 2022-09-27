@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        Изменение метки
    </h1>

    {{ Form::model($label, ['method' => 'PATCH', 'url' => route('labels.update', $label)]) }}
        @include('label.form')
        {{ Form::submit('Обновить', ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
