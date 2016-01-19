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
                            var selectOnlyOption = data.length <= 1;
                            response($.map(data, function(item, index) {
                                return {
                                    label: item,
                                    value: index,
                                    selected: {{ $selectedLevel }} // Select if only option
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