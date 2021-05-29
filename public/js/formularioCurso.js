$(document).ready(function () {

    //Validación del formulario con libreria jquery validate
    $("#frm-curso").validate({

        rules: {

            nombre: {
                required: true
            },
            
            profesor: {
                required: true
            }
            
        },
        messages: {

            nombre: {
                required: "Por favor proporcione una contraseña"
            },
            
            profesor: {
                required: "Por favor seleccione un profesor"
            }
            
        }
    });
});

