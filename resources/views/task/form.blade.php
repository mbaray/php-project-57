{{ Form::label('name', __('labels.Name')) }}<br>
{{ Form::text('name', $task->name, ['class' => 'rounded border-gray-300']) }}<br>
@error('name')
<div class='text-danger'>
    {{ $message }}
</div>
@enderror

{{ Form::label('description', __('labels.Description')) }}<br>
{{ Form::textarea('description', $task->description, ['class' => 'rounded border-gray-300']) }}<br>

{{ Form::label('status_id', __('labels.Status')) }}<br>
{{ Form::select('status_id', $taskStatuses, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300']) }}<br>
@error('status_id')
<div class='text-danger'>
    {{ $message }}
</div>
@enderror

{{ Form::label('assigned_to_id', __('labels.Executor')) }}<br>
{{ Form::select('assigned_to_id', $users, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300']) }}<br>

{{ Form::label('labels[]', __('labels.Labels')) }}<br>
{{ Form::select('labels[]', $labels, null, ['placeholder' => '', 'class' => 'form rounded border-gray-300', 'multiple']) }}<br><br>
