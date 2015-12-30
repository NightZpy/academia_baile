@if (isset($academy) AND !$academy->isCompleteData)
    <div class="alert alert-danger text-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Los datos de su academia no están completos, puedes llenar los restantes <a href="{{ route('pluranza.academies.edit', $academy->id) }}">AQUÍ</a>.
    </div>
@endif