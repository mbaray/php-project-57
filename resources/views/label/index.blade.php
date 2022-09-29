@extends('layouts.app')

@section('content')
    <div class='container-lg'>
        <h1 class='font-semibold text-xl text-gray-800'>
            {{ __('labels.Labels') }}
        </h1>

        @auth
            <a class='btn btn-outline-success mb-2' href='{{ route('labels.create')}}'> {{ __('labels.CreateLabel') }} </a>
        @endauth
        <div class='table-responsive mb-5'>
            <table class='table table-success table-striped-columns'>
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>{{ __('labels.Name') }}</th>
                    <th>{{ __('labels.Description') }}</th>
                    <th>{{ __('labels.DateOfCreation') }}</th>
                    @auth
                        <th>{{ __('labels.Actions') }}</th>
                    @endauth
                </tr>

                @foreach ($labels as $label)
                    <tr>
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->created_at->format('d.m.Y') }}</td>

                        @auth
                        <td>
                            <a href='{{ route('labels.destroy', $label->id) }}' data-confirm='{{ __('labels.confirmation') }}' data-method='delete' rel='nofollow' class='text-danger'> {{ __('labels.Delete') }} </a>/
                            <a href='{{ route('labels.edit', $label->id) }}' class='text-success'> {{ __('labels.Edit') }} </a>
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
