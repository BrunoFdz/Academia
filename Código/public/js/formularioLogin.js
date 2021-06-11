$(document).ready(function () {

    $("#frm-login").validate({

        rules: {

            username: {
                required: true
            },
            
            password:{
                required: true
            }

        }
        ,
        messages: {

            username: {
                required: "Por favor introduzca un nombre de usuario",
            },
            
            password: {
                required: "Por favor introduzca una contraseña"
            }
        }
    }
    );
});


