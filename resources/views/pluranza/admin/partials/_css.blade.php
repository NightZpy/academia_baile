{!! Html::style('/assets/css/bootstrap.css') !!}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- BOOTSTRAP FILEUPLOAD -->
{!! HTML::style('/assets/plugins/fileinput/fileinput.min.css') !!}
<!-- DATATABLES -->

{!! HTML::style('/assets/plugins/datatables/DataTables-1.10.10/css/dataTables.bootstrap.min.css') !!}
{!! HTML::style('/assets/plugins/datatables/AutoFill-2.1.0/css/autoFill.bootstrap.css') !!}
{!! HTML::style('/assets/plugins/datatables/Buttons-1.1.0/css/buttons.bootstrap.min.css') !!}
{!! HTML::style('/assets/plugins/datatables/FixedColumns-3.2.0/css/fixedColumns.bootstrap.min.css') !!}
{!! HTML::style('/assets/plugins/datatables/FixedHeader-3.1.0/css/fixedHeader.bootstrap.min.css') !!}
{!! HTML::style('/assets/plugins/datatables/KeyTable-2.1.0/css/keyTable.bootstrap.min.css') !!}
{!! HTML::style('/assets/plugins/datatables/Responsive-2.0.0/css/responsive.bootstrap.min.css') !!}
{!! HTML::style('/assets/plugins/datatables/RowReorder-1.1.0/css/rowReorder.bootstrap.min.css') !!}
{!! HTML::style('/assets/plugins/datatables/Scroller-1.4.0/css/scroller.bootstrap.min.css') !!}

{!! Html::style('/assets/css/style.css') !!}
{!! Html::style('/assets/css/salsa.css') !!}

{!! Html::style('/assets/css/custom.css') !!}

@yield('styles')

<style>
    li.paginate_button.active {
        background-color: grey;
    }
</style>