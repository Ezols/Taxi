<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
  <label class="control-label" for="{{ $name }}">{{ $label }}</label>
  <select class="form-control" name="{{ $name }}" id="{{ $name }}">
      @foreach($options as $value => $option)
          <option value="{{ $value }}" {{ old($name) === $value ? 'selected' : '' }}>{{ $option }}</option>
      @endforeach
  </select>
  @if($errors->has($name))
      <span class="help-block">{{ $errors->first($name) }}</span>
  @endif
</div>
