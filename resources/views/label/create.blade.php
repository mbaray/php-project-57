@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        {{ __('labels.CreateLabel') }}
    </h1>

    {{ Form::model($label, ['route' => 'labels.store']) }}
        @include('label.form')
        {{ Form::submit(__('labels.Create'), ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
