{{ Form::label('name', __('labels.Name')) }}
{{ Form::text('name', $taskStatus->name, ['class' => 'rounded border-gray-300']) }}<br>
@error('name')
<div class='text-danger'>
    {{ $message }}
</div>
@enderror
