@extends('layouts.app')

@section('content')
    <section class='bg-secondary dark:bg-gray-900'>
        <div class='container text-center pb-5'>
            <div class='row gx-5'>
                <h2 class='font-semibold text-xl text-gray-800 leading-tight mt-5 mb-3'>
                    {{ __('labels.hexlet') }}
                </h2>
                <h2 class='font-semibold text-grey mb-2'>
                    {{ __('labels.TaskManagerInLaravel') }}
                </h2>

                <div class='col'>
                    <a class='btn btn-outline-dark p-6 font-semibold leading-tight' href='{{ route('tasks.index') }}'> {{ __('labels.PushMe') }} </a>
                </div>
            </div>
        </div>
    </section>
@endsection
