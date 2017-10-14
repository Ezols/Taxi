<div class="row">
    <div class="col-sm-2 text-right">
        {{ $label }}
    </div>
    <div class="col-sm-9">
        @if($value)
            <strong>{{ $value }}</strong>
        @else
            Not assigned yet
        @endif

    </div>
</div>
