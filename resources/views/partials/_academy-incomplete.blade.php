@if (isset($currentAcademy) AND !$currentAcademy->isDataComplete)
    <div class="alert alert-danger text-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Los datos de su academia no están completos, puedes llenar los restantes <a href="{{ route('pluranza.academies.edit', $currentAcademy->id) }}" class="ct-js-btnScroll">AQUÍ</a>.
    </div>
@endif