{{ $table->render() }}

@if(!isset($scriptTableTemplate))
    @push('scripts')
        {{ $table->script() }}
    @stop
@endif