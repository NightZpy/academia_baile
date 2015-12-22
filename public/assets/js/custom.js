var cleanElement = function(element) {
    $(element).empty();
}

var CustomApp = function () {

    /*-----------------------------------------------------------------------------------*/
    /*  Bootstrap FileInput
     /*-----------------------------------------------------------------------------------*/
    var handleBootstrapFileInput = function() {
        try {
            $(".file-upload").fileinput({
                previewFileType: "image",
                browseClass: "btn btn-xs btn-primary text-uppercase ct-u-size14",
                browseLabel: " Buscar",
                browseIcon: '<i class="fa fa-picture-o"></i>',
                removeClass: "btn btn-xs btn-danger text-uppercase ct-u-size14",
                removeLabel: " Eliminar",
                removeIcon: '<i class="fa fa-trash"></i>',
                uploadClass: "btn btn-xs btn-info text-uppercase ct-u-size14",
                uploadLabel: " Subir",
                uploadIcon: '<i class="fa fa-upload"></i>',
            });

        } catch(e) {
            alert('fileinput.js no soporta navegadores antiguos!');
        }
    }

    return {
        init: function() {
            handleBootstrapFileInput();
        }
    }
}();