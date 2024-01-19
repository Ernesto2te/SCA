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
                                <h2 class="text-center"> Directorio de Alumnos</h2>


                            </div>
                            <h5>Registre y Busque informacion de los alumnos del instituto </h5>
                        </div>
                    </div>




                    <!-- Container-fluid starts-->
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Zero Configuration  Starts-->
                            <div class="col-sm-12">

                                <div class="text-center mt-4">
                                    <button type="button" id="btnAgregarAl" class="btn btn-info btn-sm"><i></i> Agregar
                                        Alumno</button>
                                </div>

                                <!-- VENTANA MODAL PARA REGISTRO -->
                                <div class="modal fade" id="modal-agregar-alumno" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- MODAL HEADER -->
                                            <div class="modal-header d-flex justify-content-center align-items-center"
                                                style="background-color: #fff1">
                                                <h4 class="modal-title text-center"> <i class="fa fa-folder"
                                                        aria-hidden="true"></i> Agregar Alumno
                                                </h4>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <!-- MODAL BODY -->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Columna 1 -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="hidden" id="idAlumno" name="Idalumno" value="">
                                                            <h5 for="txtNombres"> <i class="fa fa-user"
                                                                    aria-hidden="true"></i> Nombre(s)</h5>
                                                            <input type="text" class="form-control" name="Nombres"
                                                                id="txtNombres" placeholder="Ingrese Nombre(s)">
                                                            <label for="txtNombres" id="lbnombres"></label>
                                                        </div>
                                                    </div>

                                                    <!-- Columna 1.2 -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="hidden" id="idMatricula" name="IdMatricula"
                                                                value="">
                                                            <h5 for="txtMatricula"> <i class="fa fa-user"
                                                                    aria-hidden="true"></i> Matrícula</h5>
                                                            <input type="text" class="form-control" name="Matricula"
                                                                id="txtMatricula" placeholder="Ingrese Matrícula">
                                                            <label for="txtMatricula" id="lbMatricula"></label>
                                                        </div>
                                                    </div>

                                                    <!-- Columna 2 -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="hidden" id="idAlumnoApellido"
                                                                name="IdalumnoApellido" value="">
                                                            <h5 for="txtAPaterno"> <i class="fa fa-user"
                                                                    aria-hidden="true"></i> Apellido Paterno
                                                            </h5>
                                                            <input type="text" class="form-control" name="APaterno"
                                                                id="txtAPaterno" placeholder="Ingrese Apellido Paterno">
                                                            <label for="txtAPaterno" id="lbApellido"></label>
                                                        </div>
                                                    </div>

                                                    <!-- Columna 3 -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <h5 for="txtAMaterno"><i class="fa fa-user"
                                                                    aria-hidden="true"></i> Apellido Materno</h5>
                                                            <input type="text" class="form-control" name="AMaterno"
                                                                id="txtAMaterno" placeholder="Ingrese Apellido Materno">
                                                        </div>
                                                    </div>

                                                    <!-- Otras columnas y elementos aquí -->

                                                    <!-- Grupo -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <select class="form-select form-control-lg" id="GrupoA"
                                                                aria-label="Default select example">
                                                                <option disabled selected value="">Grupo</option>
                                                                <option>1 "A"</option>
                                                                <option>2 "B"</option>
                                                                <option>3 "C"</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- MODAL FOOTER -->
                                            <div class="modal-footer justify-content-end"
                                                style="background-color:#e6eeff" id="miFooter">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                        class="fa fa-times"></i> Cerrar
                                                </button>
                                                <button type="button" id="btnGuardaR" class="btn btn-primary "><i
                                                        class="fa fa-check"></i> Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- ===============================================================-->

                                <!-- ===============================================================-->


                                <!-- VENTANA MODAL PARA Editar-->
                                <div class="modal fade" id="modal-Editar-alumno" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- MODAL HEADER -->
                                            <div class="modal-header d-flex justify-content-center align-items-center"
                                                style="background-color: #fff1">
                                                <h4 class="modal-title text-center"> <i class="fa fa-folder"
                                                        aria-hidden="true"></i> Editar Alumno
                                                </h4>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <!-- MODAL BODY -->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Columna 1 -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="hidden" id="idAlumno" name="Idalumno" value="">
                                                            <h5 for="txtNombresE"> <i class="fa fa-user"
                                                                    aria-hidden="true"></i> Nombre(s)</h5>
                                                            <input type="text" class="form-control" name="NombresE"
                                                                id="txtNombresE" placeholder="Ingrese Nombre(s)">
                                                            <label for="txtNombresE" id="lbnombresE"></label>
                                                        </div>
                                                    </div>

                                                    <!-- Columna 1.2 -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="hidden" id="idMatricula" name="IdMatricula"
                                                                value="">
                                                            <h5 for="txtMatricula"> <i class="fa fa-user"
                                                                    aria-hidden="true"></i> Matrícula</h5>
                                                            <input type="text" class="form-control" name="MatriculaE"
                                                                id="txtMatriculaE" placeholder="Ingrese Matrícula">
                                                            <label for="txtMatriculaE" id="lbMatricula"></label>
                                                        </div>
                                                    </div>

                                                    <!-- Columna 2 -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="hidden" id="idAlumnoApellidoE"
                                                                name="IdalumnoApellidoE" value="">
                                                            <h5 for="txtAPaterno"> <i class="fa fa-user"
                                                                    aria-hidden="true"></i> Apellido Paterno
                                                            </h5>
                                                            <input type="text" class="form-control" name="APaternoE"
                                                                id="txtAPaternoE" placeholder="Ingrese Apellido Paterno">
                                                            <label for="txtAPaternoE" id="lbApellido"></label>
                                                        </div>
                                                    </div>

                                                    <!-- Columna 3 -->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <h5 for="txtAMaternoE"><i class="fa fa-user"
                                                                    aria-hidden="true"></i> Apellido Materno</h5>
                                                            <input type="text" class="form-control" name="AMaternoE"
                                                                id="txtAMaternoE" placeholder="Ingrese Apellido Materno">
                                                        </div>
                                                    </div>

                                                    <!-- Otras columnas y elementos aquí -->

                                                    <!-- Grupo -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <select class="form-select form-control-lg" id="GrupoAE"
                                                                aria-label="Default select example">
                                                                <option disabled selected value="">Grupo</option>
                                                                <option>1 "A"</option>
                                                                <option>2 "B"</option>
                                                                <option>3 "C"</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- MODAL FOOTER -->
                                            <div class="modal-footer justify-content-end"
                                                style="background-color:#e6eeff" id="miFooter">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                        class="fa fa-times"></i> Cerrar
                                                </button>
                                                <button type="button" id="btnEditarR" class="btn btn-primary "><i
                                                        class="fa fa-check"></i>Editar</button>
                                            </div>
                                        </div>


                                    </div>


                                </div>


                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="basic-1">
                                            <thead>
                                                <tr>
                                                    <th>Matrícula</th>
                                                    <th>Nombre(s)</th>
                                                    <th>Apellido Paterno</th>
                                                    <th>Apellido Materno</th>
                                                    <th>Grupo</th>
                                                    <th>Acciones</th>
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

<script src="js/alumnos.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>