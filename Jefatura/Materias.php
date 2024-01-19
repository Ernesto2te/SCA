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
                                <h2 class="text-center"> Materias</h2>


                            </div>
                            <h5>Registre y Busque Materias </h5>
                        </div>
                    </div>




                    <!-- Container-fluid starts-->
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Zero Configuration  Starts-->
                            <div class="col-sm-12">

                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="btn-agregar-alumno btnAgregarM d-flex justify-content-center">
                                            <button type="button" id="btnAgregarM" class="btn btn-info btn-sm mb-4"><i
                                                    class="fa fa-plus-square"></i> Agregar Materia</button>
                                        </div>
                                    </div>
                                </section>
                                <!-- VENTANA MODAL PARA REGISTRO Y ACTUALIZACION -->
                                <div class="modal fade" role="dialog" tabindex="-1" id="modal-agregar-reticula"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header" id="modal-header"
                                                style="background-color:#e6eeff">
                                                <h4 class="modal-title" style="text-align: center;">
                                                    <i class="fa fa-folder" aria-hidden="true"></i> Agregar Materia
                                                </h4>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close" data-bs-original-title="" title=""></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <h5 for="txtMateria"><i class="fa fa-language"
                                                                    aria-hidden="true"></i> Materia</h5>
                                                                    <input type="text" class="form-control" id="txtMateriaAgregar" placeholder="Ingrese Materia">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <h5 for="txtClaveM"><i class="fa fa-language"
                                                                    aria-hidden="true"></i> Clave</h5>
                                                                    <input type="text" class="form-control" id="txtClaveMAgregar" placeholder="Ingrese Clave">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-end"
                                                style="background-color:#e6eeff" id="miFooter">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                        class="fa fa-times"></i> Cerrar</button>
                                                <button type="button" id="btnGuardaR" class="btn btn-primary"><i
                                                        class="fa fa-check"></i> Guardar</button>
                                       
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <!-- VENTANA MODAL PARA ACTUALIZACION -->
                                <div class="modal fade" role="dialog" tabindex="-1" id="modal-editar-reticula"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header" id="modal-header"
                                                style="background-color:#e6eeff">
                                                <h4 class="modal-title" style="text-align: center;">
                                                    <i class="fa fa-folder" aria-hidden="true"></i> Editar Materia
                                                </h4>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close" data-bs-original-title="" title=""></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <h5 for="txtMateria"><i class="fa fa-language"
                                                                    aria-hidden="true"></i> Materia</h5>
                                                                    <input type="text" class="form-control" id="txtMateriaEditar" placeholder="Ingrese Materia">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <h5 for="txtClaveM"><i class="fa fa-language"
                                                                    aria-hidden="true"></i> Clave</h5>
                                                                    <input type="text" class="form-control" id="txtClaveMEditar" placeholder="Ingrese Clave">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-end"
                                                style="background-color:#e6eeff" id="miFooter">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                        class="fa fa-times"></i> Cerrar</button>

                                                <button type="button" id="btnEditarR" class="btn btn-primary"><i
                                                        class="fa fa-check"></i> Editar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>




                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="basic-1">
                                            <thead>
                                                <tr>
                                                    <th> Nombre Matería </th>
                                                    <th> Clave Matería </th>

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
<script src="js/materiasR.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>