@extends('layouts.app')

@section('content')
    {{ Form::model($label, ['method' => 'PATCH', 'url' => route('labels.update', $label)]) }}
    @include('label.form')
        {{ Form::submit('Обновить') }}
    {{ Form::close() }}
@endsection
