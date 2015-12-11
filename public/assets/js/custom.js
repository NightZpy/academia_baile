var CustomApp = function () {

    var cascadingAddressSelecting = function ()  {
        $('.address-select').cascadingDropdown({
            selectBoxes: [
                {
                    selector: '.estate-select',
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
                    }
                },
                {
                    selector: '.parish-select',
                    requires: ['.estate-select', '.municipality-select'],
                    requireAll: true,
                    source: function(request, response) {
                        var municipalityId = $('.municipality-select').val();
                        $.getJSON('/parroquias/por-municipio/' + municipalityId, request, function(data) {
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
                        // do stuff
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
                        // do stuff
                    },
                    onReady: function(event, dropdownData) {
                        // do stuff
                    }
                }
            ]
        });
    }

    return {
        init: function() {
            cascadingAddressSelecting();
        }
    }
}();