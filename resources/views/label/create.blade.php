@extends('layouts.app')

@section('content')
    <h1>Создать метку</h1>

    {{ Form::model($label, ['route' => 'labels.store']) }}
        @include('label.form')
        {{ Form::submit('Создать') }}
    {{ Form::close() }}
@endsection
