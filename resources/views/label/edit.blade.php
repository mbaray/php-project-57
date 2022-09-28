@extends('layouts.app')

@section('content')
    <h1 class='font-semibold text-xl text-gray-800'>
        {{ __('labels.EditLabel') }}
    </h1>

    {{ Form::model($label, ['method' => 'PATCH', 'url' => route('labels.update', $label)]) }}
        @include('label.form')
        {{ Form::submit(__('labels.Update'), ['class' => 'btn btn-outline-success mb-2']) }}
    {{ Form::close() }}
@endsection
