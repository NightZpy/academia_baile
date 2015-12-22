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
                },
                {
                    selector: '.competition-type-select',
                    requires: ['.category-select', '.level-select'],
                    requireAll: true,
                    source: function (request, response) {
                        var levelId = $('.level-select').val();
                        $.getJSON('/pluranza/categorias-en-competencia/api/lista/por-nivel/' + levelId, request, function (data) {
                            response($.map(data, function (item, index) {
                                return {
                                    label: item,
                                    value: index,
                                    selected: index == 0 // Select first available option
                                };
                            }));
                        });
                    }
                }
            ]
        });
    });
</script>
@endpush