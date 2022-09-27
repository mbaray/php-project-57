@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class='font-semibold text-xl text-gray-800'>
            Статусы
        </h1>

        @auth
            <a class='btn btn-outline-success mb-2' href='{{ route('task_statuses.create')}}'> Создать статус </a>
        @endauth
        <div class="table-responsive mb-5">
            <table class="table table-success table-striped-columns">
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
                            <a href='{{ route('task_statuses.destroy', $taskStatus->id) }}' data-confirm="Вы уверены?" data-method="delete" rel="nofollow" class="text-danger"> Удалить </a>/
                            <a href='{{ route('task_statuses.edit', $taskStatus->id) }}' class="text-success"> Изменить </a>
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
