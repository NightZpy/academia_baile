@role('admin')
@if (!isset($configuration))
    <div class="alert alert-danger text-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Debe configurar la información de la academia, puede hacerlo <a href="{{ route('configurations.new') }}" class="ct-js-btnScroll">AQUÍ</a>.
    </div>
@endif
@endrole