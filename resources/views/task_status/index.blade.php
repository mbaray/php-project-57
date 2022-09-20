@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Статусы</h1>
        <a href="{{ route('task_statuses.create')}}"> Создать статус </a>

        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>

                @foreach ($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{ $taskStatus->id }}</td>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at }}</td>
                        <td>

                            <a href='{{ route('task_statuses.destroy', $taskStatus->id) }}' data-confirm="Вы уверены?" data-method="delete" rel="nofollow"> Удалить </a>/

{{--                            <input type="submit" value="Сохранить" data-disable-with="Сохраняем">--}}

{{--                            <a href="{{ route('task_statuses.destroy', $taskStatus->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Delete</a>--}}

                            <a href='{{ route('task_statuses.edit', $taskStatus->id) }}'> Изменить </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $taskStatuses->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
