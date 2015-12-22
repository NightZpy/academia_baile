@push('scripts')
<script>
    jQuery(document).ready(function() {
        $('.competitor-select').cascadingDropdown({
            selectBoxes: [
                {
                    selector: '.category-select',
                    onChange: function(event, value, requiredValues){
                        //cleanElement('.municipality-select');
                        //cleanElement('.city-select');
                        $('.level-select').empty();
                    }
                },
                {
                    selector: '.level-select',
                    requires: ['.category-select'],
                    source: function(request, response) {
                        var categoryId = $('.category-select').val();
                        $.getJSON('/pluranza/categorias-en-competencia/api/lista/por-categoria/' + categoryId, request, function(data) {
                            var selectOnlyOption = data.length <= 1;
                            response($.map(data, function(item, index) {
                                return {
                                    label: item,
                                    value: index,
                                    selected: selectOnlyOption // Select if only option
                                };
                            }));
                        });
                    },
                    onChange: function(event, value, requiredValues){
                        //cleanElement('.parish-select');
                    },
                }
            ]
        });
    });
</script>
@endpush