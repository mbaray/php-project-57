@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Задачи</h1>

        @if (Auth::check())
            <a href='{{ route('tasks.create')}}'> Создать задачу </a>
        @endif


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
                    @if (Auth::check())
                        <th>Действия</th>
                    @endif
                </tr>

                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $taskStatuses[$task->status_id] }}</td>
                        <td><a href="{{ route('tasks.show', $task->id)}}">{{ $task->name }}</a></td>
                        <td>{{ $users[$task->created_by_id] }}</td>
                        <td>{{ $users[$task->assigned_to_id] ?? ''}}</td>
                        <td>{{ $task->created_at }}</td>

                        @if (Auth::check())
                        <td>
                            <a href='{{ route('tasks.destroy', $task->id) }}' data-confirm="Вы уверены?" data-method="delete" rel="nofollow"> Удалить </a>/
                            <a href='{{ route('tasks.edit', $task->id) }}'> Изменить </a>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
