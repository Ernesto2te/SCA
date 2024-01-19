<?php
include '../includes/head.php';
include '../includes/Jefatura.php';
?>

<link rel="stylesheet" href="../assets/css/nueva_hoja.css">
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            <div class="container-fluid">
                <div class="card">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="text-center"> Agregar Profesor</h2>


                            </div>
                            <h5>Registre y Busque informacion de los profesores </h5>
                        </div>
                    </div>




                    <!-- Container-fluid starts-->
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Zero Configuration  Starts-->
                            <div class="col-sm-12">

                                <div class="text-center mt-4">
                                    <button type="button" id="btnAgregarProfe" class="btn btn-info btn-sm"><i></i>
                                        Agregar
                                        Maestro</button>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="button" id="btnAgregarUsuario" class="btn btn-info btn-sm"><i></i>
                                        Asignar Usuario</button>
                                </div>
                                <!-- VENTANA MODAL PARA REGISTRO -->
                                <div class="modal fade" id="modal-agregar-profesor" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <!-- MODAL HEADER -->
                                            <div class="modal-header" style="background-color: #fff1">
                                                <h4 class="modal-title text-center"> <i class="fa fa-folder"
                                                        aria-hidden="true"></i> Agregar Profesor</h4>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <!-- MODAL BODY -->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="txtNombreProfe">Nombre(s)</label>
                                                            <input type="text" class="form-control" name="NombreProfe"
                                                                id="txtNombreProfe" placeholder="Ingrese Nombre(s)">
                                                            <label for="txtNombreProfe" id="lbnombreProfe"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="txtApellidoProfeP">Apellido Paterno</label>
                                                            <input type="text" class="form-control"
                                                                name="txtApellidoProfeP" id="txtApellidoProfeP"
                                                                placeholder="Ingrese Apellido Paterno">
                                                            <label for="txtApellidoProfeP" id="lbnombreProfeP"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="Apellid_ProfeM">Apellido Materno</label>
                                                            <input type="text" class="form-control"
                                                                name="Apellid_ProfeM" id="Apellid_ProfeM"
                                                                placeholder="Ingrese Apellido Materno">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="txtClaveProfe">Clave</label>
                                                            <input type="text" class="form-control" name="txtClaveProfe"
                                                                id="txtClaveProfe" placeholder="Clave">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MODAL FOOTER -->
                                            <div class="modal-footer justify-content-end"
                                                style="background-color: #e6eeff" id="miFooter">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                        class="fa fa-times"></i> Cerrar</button>
                                                <button type="button" id="btnGuardarMaestro" class="btn btn-primary"><i
                                                        class="fa fa-check"></i> Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- VENTANA MODAL PARA EDITAR -->
                                <div class="modal fade show" role="dialog" tabindex="-1" id="modal-editar-profesor"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- MODAL HEADER -->
                                            <div class="modal-header d-flex justify-content-center align-items-center"
                                                style="background-color: #fff1;">
                                                <h4 class="modal-title text-center"><i class="fa fa-folder"
                                                        aria-hidden="true"></i> Editar Profesor</h4>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <!-- MODAL BODY -->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Nombre -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="hidden" id="idAlumno" name="IdalumnoEd">
                                                            <label for="txtNombresEd"><i class="fa fa-user"
                                                                    aria-hidden="true"></i> Nombre(s)</label>
                                                            <input type="text" class="form-control" name="NombresEd"
                                                                id="txtNombresEd" placeholder="Ingrese Nombre(s)">
                                                        </div>
                                                    </div>

                                                    <!-- Apellido Paterno -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="txtApellidoEd"><i class="fa fa-user"
                                                                    aria-hidden="true"></i> Apellido Paterno</label>
                                                            <input type="text" class="form-control" name="ApellidoEd"
                                                                id="txtApellidoEd"
                                                                placeholder="Ingrese Apellido Paterno">
                                                        </div>
                                                    </div>

                                                    <!-- Apellido Materno -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="txtApellidoMEd"><i class="fa fa-user"
                                                                    aria-hidden="true"></i> Apellido Materno</label>
                                                            <input type="text" class="form-control" name="ApellidoMEd"
                                                                id="txtApellidoMEd"
                                                                placeholder="Ingrese Apellido Materno">
                                                        </div>
                                                    </div>

                                                    <!-- Clave -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="txtClaveED"><i class="fa fa-key"
                                                                    aria-hidden="true"></i> Clave</label>
                                                            <input type="text" class="form-control" name="txtClaveED"
                                                                id="txtClaveED" placeholder="Clave">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MODAL FOOTER -->
                                            <div class="modal-footer justify-content-end"
                                                style="background-color:#e6eeff;">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                        class="fa fa-times"></i> Cerrar</button>
                                                <button type="button" id="btnEditarR" class="btn btn-primary"><i
                                                        class="fa fa-check"></i> Editar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIN MODAL EDITAR -->

                                <!-- VENTANA MODAL Agregar Usuario a Maestro -->
                                <div class="modal fade" id="modal-agregar-Usuario">
                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header" style="background-color:#e6eeff">
                                                <h4 class="modal-title">Agregar Usuario a Maestro</h4>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <!-- Correo Electrónico -->
                                                <div class="row">
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <label for="txtCorreo" style="color: black;">
                                                                <i class="fa fa-envelope" aria-hidden="true"></i> Correo
                                                                Electrónico
                                                            </label>
                                                            <input type="email" class="form-control" id="txtCorreo"
                                                                placeholder="Ingrese el correo electrónico del maestro">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Contraseña -->
                                                <div class="row">
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <label for="txtContraseña" style="color: black;">
                                                                <i class="fa fa-lock" aria-hidden="true"></i> Contraseña
                                                            </label>
                                                            <input type="password" class="form-control"
                                                                id="txtContraseña"
                                                                placeholder="Ingrese una contraseña segura">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Selección de Maestro -->
                                                <div class="mb-3 row">
                                                    <label for="selectMaestro" style="color: black;"
                                                        class="col-sm-4 col-form-label">
                                                        <i class="fa fa-user" aria-hidden="true"></i> Seleccione un
                                                        Maestro
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select id="selectMaestro"
                                                            class="form-select form-control-lg custom-select">
                                                            <option value="" disabled selected>Seleccione un maestro
                                                            </option>
                                                            <!-- Opciones de maestros aquí -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="button" data-bs-dismiss="modal"><i
                                                        class="fa fa-times"></i> Cerrar</button>
                                                <button type="button" id="btnGuardarUsuarioMaestro"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Guardar
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="basic-1">
                                            <thead>
                                                <tr>

                                                    <th>Nombre</th>
                                                    <th>Apellido Materno</th>
                                                    <th>Apellido Paterno</th>
                                                    <th>Clave</th>
                                                    <th>Acción</th>

                                                </tr>

                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Zero Configuration  Ends-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include '../includes/footer.php'
?>

< <script src="js/Profesores.js">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>