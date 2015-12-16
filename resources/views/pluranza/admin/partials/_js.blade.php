@include('layout.includes._js')
<!-- Jquery Cascading Dropdown -->
{!! Html::script('/assets/plugins/cascadingdropdown/jquery.cascadingdropdown.js') !!}
<!-- BOOTSTRAP FILEUPLOAD -->
{!! HTML::script('/assets/plugins/fileinput/fileinput.min.js') !!}
{!! HTML::script('/assets/plugins/fileinput/fileinput_locale_es.js') !!}

<!-- DATATABLES -->
{!! HTML::script('/assets/plugins/datatables/JSZip-2.5.0/jszip.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/pdfmake-0.1.18/build/pdfmake.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/pdfmake-0.1.18/build/vfs_fonts.js') !!}
{!! HTML::script('/assets/plugins/datatables/DataTables-1.10.10/js/jquery.dataTables.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/DataTables-1.10.10/js/dataTables.bootstrap.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/AutoFill-2.1.0/js/dataTables.autoFill.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/AutoFill-2.1.0/js/autoFill.bootstrap.min.js') !!}-
{!! HTML::script('/assets/plugins/datatables/Buttons-1.1.0/js/dataTables.buttons.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/Buttons-1.1.0/js/buttons.bootstrap.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/Buttons-1.1.0/js/buttons.colVis.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/Buttons-1.1.0/js/buttons.html5.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/Buttons-1.1.0/js/buttons.print.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/FixedColumns-3.2.0/js/dataTables.fixedColumns.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/FixedHeader-3.1.0/js/dataTables.fixedHeader.min.js') !!}--}}
{!! HTML::script('/assets/plugins/datatables/KeyTable-2.1.0/js/dataTables.keyTable.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/Responsive-2.0.0/js/dataTables.responsive.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/Responsive-2.0.0/js/responsive.bootstrap.min.js') !!}
{!! HTML::script('/assets/plugins/datatables/RowReorder-1.1.0/js/dataTables.rowReorder.min.js') !!}

{!! Html::script('/assets/js/custom.js') !!}

@yield('scripts')

<script type="text/javascript" language="javascript">
    jQuery(document).ready(function() {
        // Custom inits
        CustomApp.init();    });
</script>

