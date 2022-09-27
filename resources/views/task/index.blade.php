@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Задачи</h1>

{{--        <div class="dropdown">--}}
{{--            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                Статус--}}
{{--            </button>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                <li><a class="dropdown-item" href="#">Действие</a></li>--}}
{{--                <li><a class="dropdown-item" href="#">Другое действие</a></li>--}}
{{--                <li><a class="dropdown-item" href="#">Что-то еще здесь</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}

        {{Form::open(['route' => 'tasks.index', 'method' => 'GET'])}}
            {{ Form::select('filter[status_id]', $taskStatuses, $filters['status_id'] ?? null, ['placeholder' => 'Статус'])}}
            {{ Form::select('filter[created_by_id]', $users, $filters['created_by_id'] ?? null, ['placeholder' => 'Автор'])}}
            {{ Form::select('filter[assigned_to_id]', $users, $filters['assigned_to_id'] ?? null, ['placeholder' => 'Исполнитель'])}}
            {{ Form::submit('Применить') }}
        {{Form::close()}}<br><br>

        @auth
            <a href='{{ route('tasks.create')}}'> Создать задачу </a>
        @endauth

        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Статус</th>
                    <th>Имя</th>
                    <th>Автор</th>
                    <th>Исполнитель</th>
                    <th>Дата создания</th>
                    @auth
                    <th>Действия</th>
                    @endauth
                </tr>

                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $taskStatuses[$task->status_id] }}</td>
                        <td><a href="{{ route('tasks.show', $task->id)}}">{{ $task->name }}</a></td>
                        <td>{{ $users[$task->created_by_id] }}</td>
                        <td>{{ $users[$task->assigned_to_id] ?? ''}}</td>
                        <td>{{ $task->created_at }}</td>

                        @auth
                        <td>
                            @if($task->created_by_id === auth()->user()->id)
                            <a href='{{ route('tasks.destroy', $task->id) }}' data-confirm="Вы уверены?" data-method="delete" rel="nofollow"> Удалить </a>/
                            @endif
                            <a href='{{ route('tasks.edit', $task->id) }}'> Изменить </a>
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
