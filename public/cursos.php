<?php require_once '../view/header.php'; ?>
<!-- Contenido principal -->
<main>
    <section>
        <div class="container my-5">
            <h1>
                Nuestros cursos
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active">Cursos</li>
            </ol>
            <div class="row">
                <div class="col-md-3 mb-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                         aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-java-tab" data-toggle="pill" href="#v-pills-java"
                           role="tab" aria-controls="v-pills-java" aria-selected="true">Curso de Java</a>
                        <a class="nav-link" id="v-pills-office-tab" data-toggle="pill" href="#v-pills-office"
                           role="tab" aria-controls="v-pills-office" aria-selected="false">Curso de Office365</a>
                        <a class="nav-link" id="v-pills-javascript-tab" data-toggle="pill"
                           href="#v-pills-javascript" role="tab" aria-controls="v-pills-javascript"
                           aria-selected="false"> Curso de Javascript</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings"
                           role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content mb-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-java" role="tabpanel"
                             aria-labelledby="v-pills-java-tab">
                            <div class="card text-center">
                                <h5 class="card-header">Curso de Java</h5>
                                <div class="card-body">
                                    <img class="img-fluid my-5" src="img/1366_521.jpg" alt="Imagen Java">
                                    <h5 class="card-title">Información</h5>
                                    <p class="card-text">Este curso de Java está dirigido a estudiantes y
                                        profesionales con pocas bases sobre el lenguaje de programación Java y que
                                        además desean aprender desde nivel básico hasta nivel avanzado.
                                    </p>

                                    <h5 class="mt-5 mb-3">¿Qué aprenderás?</h5>
                                    <ul class="text-left">
                                        <li>Conocer la sintaxis de un programa en Java. </li>
                                        <li>Dominar el uso de variables, constantes y ciclos en Java.</li>
                                        <li>Entender las sentencias condicionales.</li>
                                        <li>Dominar el uso de arrays y matrices. </li>
                                        <li>Dominar el paradigma de programación orientada a objetos en Java. </li>
                                        <li>Diseñar la interfaz gráfica de Java. </li>
                                        <li>Aprender a manejar archivos mediante Java. </li>
                                        <li>Trabajar Java con el gestor de bases de datos MySQL. </li>
                                    </ul>

                                    <a href="cursoJava.php" class="btn boton">Visitar</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-office" role="tabpanel"
                             aria-labelledby="v-pills-office-tab">
                            <div class="card text-center">
                                <h5 class="card-header">Curso de Office365</h5>
                                <div class="card-body">
                                    <img class="img-fluid" src="img/1903-office-365-empresas-pymes.png"
                                         alt="Imagen Java">
                                    <h5 class="card-title">Información</h5>
                                    <p class="card-text">Este curso de Office 365 está dirigido a personas con o sin
                                        conocimientos previos en informática, que deseen capacitarse de forma
                                        profesional para laborar de manera productiva, organizacional y colaborativa
                                        mediante el uso adecuado de Office 365.
                                    </p>

                                    <h5 class="mt-5 mb-3">¿Qué aprenderás?</h5>
                                    <p>El curso de Office 365 se encuentra actualizado con la versión 2019 y aborda
                                        los siguientes temas:</p>
                                    <ul class="text-left">
                                        <li>Instalación y configuración de herramientas </li>
                                        <li>Funcionamiento de las herramientas. </li>
                                        <li>Buenas prácticas de comunicación, colaboración y planificación. </li>
                                    </ul>
                                    <a href="cursoOffice365.php" class="btn boton">Visitar</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-javascript" role="tabpanel"
                             aria-labelledby="v-pills-javascript-tab">
                            <div class="tab-pane fade show active" id="v-pills-java" role="tabpanel"
                                 aria-labelledby="v-pills-java-tab">
                                <div class="card text-center">
                                    <h5 class="card-header">Curso de Javascript</h5>
                                    <div class="card-body">
                                        <img class="img-fluid mt-3 mb-5" src="img/cursoJavascript.jpg" alt="Imagen Java">
                                        <h5 class="card-title">Información</h5>
                                        <p class="card-text">Este curso de JavaScript está dirigido a personas con
                                            conocimientos previos en programación, que deseen aprender desde cero
                                            hasta un nivel avanzado el lenguaje JavaScript.
                                        </p>

                                        <h5 class="mt-5 mb-3">¿Qué aprenderás?</h5>
                                        <ul class="text-left">
                                            <li>Dominar el uso de variables, condicionales, ciclos, arreglos y funciones.</li>
                                            <li>Modificar el DOM</li>
                                            <li>Dominar el paradigma de Programación Orientada a Objetos con el lenguaje JavaScript.</li>
                                            <li>Comprender y utilizar los patrones de Asincronización de JavaScript.</li>
                                            <li>Trabajar con almacenamiento.</li>
                                        </ul>
                                        <a href="cursoJavascript.php" class="btn boton">Visitar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                             aria-labelledby="v-pills-settings-tab">...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once '../view/footer.php'; ?>