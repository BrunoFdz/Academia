$(document).ready(function () {

    //Validación del formulario con libreria jquery validate
    $("#frm-tema").validate({

        rules: {

            titulo: {
                required: true
            },
            
            descripcion: {
                required: true
            }
            
        },
        messages: {

            titulo: {
                required: "Por favor introduce un título"
            },
            
            descripcion: {
                required: "Por favor introduzca una descripción"
            }
            
        }
    });
});


