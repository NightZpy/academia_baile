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
                    requires: ['.estate-select', '.municipality-select'],
                    requireAll: true,
                    source: function (request, response) {
                        var municipalityId = $('.municipality-select').val();
                        $.getJSON('/parroquias/por-municipio/' + municipalityId, request, function (data) {
                            response($.map(data, function (item, index) {
                                return {
                                    label: item,
                                    value: index,
                                    selected: index == 0 // Select first available option
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
</script>
@endpush