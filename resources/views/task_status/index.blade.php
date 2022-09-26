@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Статусы</h1>

        @auth
            <a href='{{ route('task_statuses.create')}}'> Создать статус </a>
        @endauth
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                    @auth
                        <th>Действия</th>
                    @endauth
                </tr>

                @foreach ($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{ $taskStatus->id }}</td>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at }}</td>

                        @auth
                        <td>
                            <a href='{{ route('task_statuses.destroy', $taskStatus->id) }}' data-confirm="Вы уверены?" data-method="delete" rel="nofollow"> Удалить </a>/
                            <a href='{{ route('task_statuses.edit', $taskStatus->id) }}'> Изменить </a>
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
