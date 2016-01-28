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
                        $('.level-select')
                            .find('option')
                            .remove()
                            .end();
                        console.log($('.level-select option').size());
                    }
                },
                {
                    selector: '.level-select',
                    requires: ['.category-select'],
                    source: function(request, response) {
                        var categoryId = $('.category-select').val();
                        var competitionTypeId = $('input[name="competition_type_id"]').val();
                        var url = '/pluranza/categorias-en-competencia/api/lista/por-categoria-tipo-competencia/' + categoryId + '/' + competitionTypeId;
                        $.getJSON(url, request, function(data) {
                            var preselect = {{ $selectedLevel }};
                            response($.map(data, function(item, index) {
                                console.log(item.value + '=' + preselect);
                                if(item.value == preselect) {
                                    var selected = item.label;
                                } else {
                                    var selected = false;
                                }
                                return {
                                    label: item,
                                    value: index,
                                    selected: selected ? selected : data.length <= 1
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