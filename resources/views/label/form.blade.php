{{ Form::label('name', 'Имя') }}<br>
{{ Form::text('name') }}<br>
@error('name')
<div>
    {{ $message }}
</div>
@enderror

{{ Form::label('description', 'Описание') }}<br>
{{ Form::textarea('description') }}<br>
