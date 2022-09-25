@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Статусы</h1>

{{--        @can('create', App\Models\TaskStatus::class)--}}
        @if (Auth::check())
            <a href='{{ route('task_statuses.create')}}'> Создать статус </a>
        @endif


        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                    @if (Auth::check())
                        <th>Действия</th>
                    @endif
                </tr>

                @foreach ($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{ $taskStatus->id }}</td>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at }}</td>

{{--                        @canany(['update', 'view', 'delete'], $taskStatus)--}}
                        @if (Auth::check())
                        <td>
                            <a href='{{ route('task_statuses.destroy', $taskStatus->id) }}' data-confirm="Вы уверены?" data-method="delete" rel="nofollow"> Удалить </a>/
                            <a href='{{ route('task_statuses.edit', $taskStatus->id) }}'> Изменить </a>
                        </td>
                        @endif
{{--                        @endcanany--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $taskStatuses->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
