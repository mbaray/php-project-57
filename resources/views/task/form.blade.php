{{ Form::label('name', 'Имя') }}<br>
{{ Form::text('name') }}<br>
@error('name')
<div>
    {{ $message }}
</div>
@enderror

{{ Form::label('description', 'Описание') }}<br>
{{ Form::textarea('description') }}<br>

{{ Form::label('status_id', 'Статус') }}<br>
{{ Form::select('status_id', $taskStatuses, null, ['placeholder' => '----------']) }}<br>
@error('status_id')
<div>
    {{ $message }}
</div>
@enderror

{{ Form::label('assigned_to_id', 'Исполнитель') }}<br>
{{ Form::select('assigned_to_id', $users, null, ['placeholder' => '----------']) }}<br>

{{ Form::label('labels[]', 'Метки') }}<br>
{{ Form::select('labels[]', $labels, null, ['placeholder' => '', 'class' => 'form', 'multiple']) }}<br><br>
