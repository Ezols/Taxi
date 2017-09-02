<?php
    $value = isset($value) ? $value : '';
    $label = isset($label) ? $label : $name;
    $class = isset($class) ? $class : '';
    $isSmall = isset($isSmall) ? $isSmall : '';
    $hideLabel = isset($hideLabel) ? $hideLabel : false;
    $errorKey = isset($errorKey) ? $errorKey : $name;
    $hideErrorMessage = isset($hideErrorMessage) ? $hideErrorMessage : false;
?>

<div class="form-group {{ $errors->has($errorKey) ? 'has-error' : '' }}">

    @if(!$hideLabel)
        <label class="control-label" for="{{ $name }}">{{ $label }}</label>
    @endif

    <select class="form-control {{ $isSmall ? 'input-sm' : '' }} {{ $class or '' }}" name="{{ $name }}" id="{{ $name }}">
        @foreach($options as $optionValue => $option)
            <option value="{{ $optionValue }}" {{ old($errorKey, $value) === $optionValue ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>

    @if($errors->has($errorKey) && !$hideErrorMessage)
        <span class="help-block">{{ $errors->first($errorKey) }}</span>
    @endif
</div>
