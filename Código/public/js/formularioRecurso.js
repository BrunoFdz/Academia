$(document).ready(function () {

    //Mostramos el nombre del fichero que seleccionamos en el input
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    //Método para comprobar el tamaño del fichero. Comprueba que el tamaño del fichero es menos o igual al indicado
    // en bytes
    $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
    });

    $("#frm-recurso").validate({

        rules: {

            fichero: {
                required: true,
                //Tamaño máximo 6000000 bytes (6 MB)
                filesize: 6000000
            }

        }
        ,
        messages: {

            fichero: {
                required: "Por favor seleccione un fichero",
                filesize: "Fichero demasiado grande"
            }

        }
    }
    );
});

