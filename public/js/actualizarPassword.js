$(document).ready(function () {

    //Creamos un método regex que nos permita añadir expresiones regulares a la validación del formulario
    $.validator.addMethod("regex", function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    });

    //Validación del formulario con libreria jquery validate
    $("#frm-usuario").validate({

        rules: {

            password: {
                required: true,
                minlength: 8,
                regex: /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/
            }
            
        },
        messages: {

            password: {
                required: "Por favor proporcione una contraseña",
                minlength: "Su contraseña debe tener al menos 8 caracteres.",
                regex: "La contraseña debe tener como mínimo una minúscula, una mayúscula y un número"
            }
            
        }
    });
});



