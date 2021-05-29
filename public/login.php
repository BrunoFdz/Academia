<?php require_once '../view/header.php'; ?>
<!-- Contenido principal -->
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">                        
            <div class="col-xl-6 col-lg-7 col-8">
                <div class="errorFormulario text-center mt-5"><h2><?php if(isset($_REQUEST['error'])) echo "Error en el login" ?></h2></div>
                <div class="row login_general">
                    <div class="col-md-3 d-none d-sm-none d-md-flex bg-dark text-center justify-content-center align-items-center login_logo">
                        <img src="img/logo-login.png" alt="Logo FI Academia" class="img-fluid">
                    </div>
                    <div class="col-md-9 col-xs-12 col-sm-12 login_form">
                        <div class="container-fluid h-100">
                            <div class="row mt-4">                                
                                <div class="col text-center">
                                    <h2>Login</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form id="frm-login" class="px-4" action="index.php?c=Usuario&a=login" method="post">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="username" id="username" class="form_input"
                                                       placeholder="Usuario">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <input type="password" name="password" id="password"
                                                       class="form_input" placeholder="Contraseña">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="submit" value="Acceder" class="btn btn-submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="js/formularioLogin.js"></script>
<?php require_once '../view/footer.php'; ?>