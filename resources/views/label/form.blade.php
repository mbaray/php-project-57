{{ Form::label('name', __('labels.Name')) }}<br>
{{ Form::text('name', $label->name, ['class' => 'rounded border-gray-300']) }}<br>
@error('name')
<div class='text-danger'>
    {{ $message }}
</div>
@enderror

{{ Form::label('description', __('labels.Description')) }}<br>
{{ Form::textarea('description', $label->description, ['class' => 'rounded border-gray-300']) }}<br>
