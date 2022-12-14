@extends('layouts.app')

@section('content')
    <div class='container-lg'>
        <h1 class='font-semibold text-xl text-gray-800'>
            {{ __('labels.Tasks') }}
        </h1>

        {{Form::open(['route' => 'tasks.index', 'method' => 'GET'])}}
            {{ Form::select('filter[status_id]', $taskStatuses, $filters['status_id'] ?? null, ['placeholder' => __('labels.Status'), 'class' => 'rounded border-gray-300'])}}
            {{ Form::select('filter[created_by_id]', $users, $filters['created_by_id'] ?? null, ['placeholder' => __('labels.Author'), 'class' => 'rounded border-gray-300'])}}
            {{ Form::select('filter[assigned_to_id]', $users, $filters['assigned_to_id'] ?? null, ['placeholder' => __('labels.Executor'), 'class' => 'rounded border-gray-300'])}}
            {{ Form::submit(__('labels.Apply'), ['class' => 'btn btn-outline-success']) }}
        {{Form::close()}}<br>

        @auth
            <a class='btn btn-outline-success mb-2' href='{{ route('tasks.create')}}'> Создать задачу </a>
        @endauth

        <div class='table-responsive mb-5'>
            <table class='table table-success table-striped-columns'>
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>{{ __('labels.Status') }}</th>
                    <th>{{ __('labels.Name') }}</th>
                    <th>{{ __('labels.Author') }}</th>
                    <th>{{ __('labels.Executor') }}</th>
                    <th>{{ __('labels.DateOfCreation') }}</th>
                    @auth
                    <th>{{ __('labels.Actions') }}</th>
                    @endauth
                </tr>

                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $taskStatuses[$task->status_id] }}</td>
                        <td><a href='{{ route('tasks.show', $task->id)}}' class='text-primary'>{{ $task->name }}</a></td>
                        <td>{{ $users[$task->created_by_id] }}</td>
                        <td>{{ $users[$task->assigned_to_id] ?? ''}}</td>
                        <td>{{ $task->created_at->format('d.m.Y') }}</td>

                        @auth
                        <td>
                            @if($task->created_by_id === auth()->user()->id)
                            <a href='{{ route('tasks.destroy', $task->id) }}' data-confirm='{{ __('labels.confirmation') }}' data-method='delete' rel='nofollow' class='text-danger'> {{ __('labels.Delete') }} </a>/
                            @endif
                            <a href='{{ route('tasks.edit', $task->id) }}' class='text-success'> {{ __('labels.Edit') }} </a>
                        </td>
                        @endauth
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
