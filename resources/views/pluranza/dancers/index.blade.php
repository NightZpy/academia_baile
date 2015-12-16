@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop100">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Sólo: Bailarines de <i>{{ $academyParticipant->name }}</i>
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-10">
                    <a href="{{ route('pluranza.dancers.new', $academyParticipant->id) }}" class="ct-js-btnScroll btn btn-sm btn-danger btn-circle pull-right">Agregar</a>
                </div>
            </div>
            <div class="row ct-u-paddingTop5">
                <div class="col-md-offset-2 col-md-8">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
{{--<script type="text/javascript" language="javascript">
    jQuery(document).ready(function() {--}}
        {!! $dataTable->scripts() !!}
        {{-- $('#dancers-table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json'
            },
            processing: true,
            serverSide: true,
            ajax: '{!! route('pluranza.dancers.api.list', $academy->id) !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'bird_date', name: 'bird_date' },
                { data: 'bird_date', name: 'algo' },
                { data: 'bird_date', name: 'algo1' },
                { data: 'bird_date', name: 'algo2' },
                { data: 'bird_date', name: 'algo3' },
            ]
        }); --}}
{{--    });
</script>--}}
@endpush