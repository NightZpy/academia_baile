@push('scripts')
<script>
    jQuery(document).ready(function() {
        $('.address-select').cascadingDropdown({
            selectBoxes: [
                {
                    selector: '.estate-select',
                    onChange: function(event, value, requiredValues){
                        //cleanElement('.municipality-select');
                        //cleanElement('.city-select');
                    }
                },
                {
                    selector: '.municipality-select',
                    requires: ['.estate-select'],
                    source: function(request, response) {
                        var estateId = $('.estate-select').val();
                        $.getJSON('/municipios/por-estado/' + estateId, request, function(data) {
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
                    selector: '.parish-select',
                    requires: ['.municipality-select'],
                    @route('pluranza.academies.edit')
                        @if (isset($municipalities) AND  $academy->parish_id > 0 )
                            selected: {{ $academy->parish_id }},
                        @endif
                    @endroute
                    source: function (request, response) {
                        var municipalityId = $('.municipality-select').val();
                        $.getJSON('/parroquias/por-municipio/' + municipalityId, request, function (data) {
                            response($.map(data, function (item, index) {
                                return {
                                    label: item,
                                    value: index,
                                    selected: selectOnlyOption
                                };
                            }));
                        });
                    }
                },
                {
                    selector: '.city-select',
                    requires: ['.estate-select'],
                    requireAll: true,
                    source: function(request, response) {
                        var estateId = $('.estate-select').val();
                        $.getJSON('/ciudades/por-estado/' + estateId, request, function(data) {
                            response($.map(data, function(item, index) {
                                return {
                                    label: item,
                                    value: index,
                                    selected: index == 0 // Select first available option
                                };
                            }));
                        });
                    },
                    onChange: function(event, value, requiredValues){

                    },
                    onReady: function(event, dropdownData) {
                        // do stuff
                    }
                }
            ]
        });
    });
    $(window).bind("load", function() {
        if ($('.estate-select option').length > 0) {
            if ($( ".parish-select option:selected" ).length) {
                var element = $('option:selected', '.parish-select').val();
                if (element > 0) {
                    $('option:selected', '.parish-select').removeAttr('selected');
                    $('.parish-select').find('option[value='+element+']').attr('selected', true);
                }
            }
            $('.parish-select').prop("disabled", false);
        }
    });
</script>
@endpush