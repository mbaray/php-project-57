@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Метки</h1>

        @auth
            <a href='{{ route('labels.create')}}'> Создать метку </a>
        @endauth
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Описание</th>
                    <th>Дата создания</th>
                    @auth
                        <th>Действия</th>
                    @endauth
                </tr>

                @foreach ($labels as $label)
                    <tr>
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->created_at }}</td>

                        @auth
                        <td>
                            <a href='{{ route('labels.destroy', $label->id) }}' data-confirm="Вы уверены?" data-method="delete" rel="nofollow"> Удалить </a>/
                            <a href='{{ route('labels.edit', $label->id) }}'> Изменить </a>
                        </td>
                        @endauth
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $labels->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
