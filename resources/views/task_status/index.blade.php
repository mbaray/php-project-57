@extends('layouts.app')

@section('content')
    <div class='container-lg'>
        <h1 class='font-semibold text-xl text-gray-800'>
            {{ __('labels.Statuses') }}
        </h1>

        @auth
            <a class='btn btn-outline-success mb-2' href='{{ route('task_statuses.create')}}'> {{ __('labels.CreateStatus') }}</a>
        @endauth
        <div class='table-responsive mb-5'>
            <table class='table table-success table-striped-columns'>
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>{{ __('labels.Name') }}</th>
                    <th>{{ __('labels.DateOfCreation') }}</th>
                    @auth
                        <th>{{ __('labels.Actions') }}</th>
                    @endauth
                </tr>

                @foreach ($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{ $taskStatus->id }}</td>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                        @auth
                        <td>
                            <a href='{{ route('task_statuses.destroy', $taskStatus->id) }}' data-confirm='{{ __('labels.confirmation') }}' data-method='delete' rel='nofollow' class='text-danger'> {{ __('labels.Delete') }} </a>/
                            <a href='{{ route('task_statuses.edit', $taskStatus->id) }}' class='text-success'> {{ __('labels.Edit') }} </a>
                        </td>
                        @endauth
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $taskStatuses->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
