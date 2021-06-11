$(document).ready(function () {
    
    //Débido a que solo si el usuario es un alumno podrá seleccionar sus cursos 
    //comprobamos si el rol seleccionado es alumno , en caso de no ser así
    //ocultamos la selección de cursos
    //Cada vez que carga el documento comprobamos si el rol seleccionado es alumno
    // si no ocultamos los cursos
    if ($("input:radio[name=rol]:checked").val() == 'alumno') {
        $("#listaCursos").css("display", "block");
    } else {
        $("#listaCursos").css("display", "none");
    }

    //En caso se producirse algún cambio en el rol también comprobaremos si el rol
    // seleccionado es alumno
    $("input:radio[name=rol]").change(function () {
        if ($("input:radio[name=rol]:checked").val() == 'alumno') {
            $("#listaCursos").css("display", "block");
        } else {
            $("#listaCursos").css("display", "none");
        }
    });

    //Creamos un método regex que nos permita añadir expresiones regulares a la validación del formulario
    $.validator.addMethod("regex", function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    });

    //Validación del formulario con libreria jquery validate
    $("#frm-usuario").validate({

        rules: {

            nombre: {
                required: true,
                //Permitimos solo letras y espacios
                regex: /^[áéíóúÁÉÍOÚa-zA-Z-' ]*$/
            },
            
            apellidos: {
                required: true,
                //Permitimos solo letras y espacios
                regex: /^[áéíóúÁÉÍOÚa-zA-Z-' ]*$/
            },

            correo: {
                required: true,
                //Comprobamos que el formato del correo sea correcto
                regex: /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
                //Comprobamos que el correo no esté registrado ya en la base de datos
                remote: {
                    url: "?c=Persona&a=comprobarEmailAjax",
                    type: "post",
                    data: {
                        email: function () {
                            return $("#correo").val();
                        }
                    }
                }
            },

            nombreUsuario: {
                required: true,
                //Comprobamos que el nombre de usuario no esté registrado ya en la base de datos
                remote: {
                    url: "?c=Persona&a=comprobarNombreUsuarioAjax",
                    type: "post",
                    data: {
                        nombreUsuario: function () {
                            return $("#nombreUsuario").val();
                        }
                    }
                }
            },

            password: {
                required: true,
                minlength: 8,
                regex: /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/
            },

            rol: "required",

            "cursos[]": {
                //Si el rol de alumno está seleccionado , como mínimo un curso debe de seleccionarse
                required: {
                    depends: function () {
                        return $("#alumno").is(":checked");
                    }
                }
            }
        },
        messages: {

            nombre: {
                required: "Por favor, introduzca su nombre",
                regex: "El nombre solo puede contener letras y espacios"
            },

            apellidos: {
                required: "Por favor, introduzca sus apellidos",
                regex: "Los apellidos solo pueden contener letras y espacios"
            },

            correo: {
                required: "Por favor, introduce una dirección de correo electrónico",
                regex: "El formato del correo es inválido",
                remote: "El email ya existe"
            },

            nombreUsuario: {
                required: "Por favor, introduzca su nombre de usuario",
                remote: "El nombre de usuario ya existe"
            },

            password: {
                required: "Por favor proporcione una contraseña",
                minlength: "Su contraseña debe tener al menos 8 caracteres.",
                regex: "La contraseña debe tener como mínimo una minúscula, una mayúscula y un número"
            },

            rol: "Por favor, seleccione un rol",

            "cursos[]": "Por favor, seleccione al menos un curso"
        },
        //Establecemos la posición de los errores
        errorPlacement: function (error, element) {
            //Para los elementos de tipo radio (el rol) seleccionamos que se inserte en el div errorRol
            if (element.attr("type") == "radio") {
                $("#errorRol").append(error);
            } else {
                //Para el resto que se inserte despues del elemento
                error.insertAfter(element);
            }
        }
    });
});

