<?php
include '../includes/head.php';
include '../includes/Jefatura.php';
?>

<!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
<!-- <link rel="stylesheet" href="../assets/css/index-style.css"> -->

<head>
    <link rel="stylesheet" href="../assets/css/nueva_hoja.css">

</head>

<body>
    <!-- VENTANA MODAL PARA REGISTRO Y ACTUALIZACION -->
    <div class="modal fade show" id="modal-agregar-periodo">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content ">

                <div class="modal-header" style="background-color: #c2ff9cc3;">
                    <h4 class="modal-title">Agregar Ciclo Escolar</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-original-title="" title=""></button>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <h4><span class="badge rounded-pill badge-primary" style="color: black;">Ingrese Ciclo
                                    <i class="fa fa-slack" aria-hidden="true"></i></span></h4>
                        </div>
                    </div>
                    <!--  //este//-->
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <h5 for="" style="color: black;"><i class="fa fa-mortar-board" aria-hidden="true"></i>
                                    Ciclo</h5>
                                <input type="text" class="form-control" id="txtNE" placeholder="2022-2023">
                            </div>
                        </div>
                    </div>

                    <!-- =================================================================-->
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <h5 for="" style="color: black;"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                    Status</h5>
                                <input type="text" class="form-control" value="Activo" Disabled id="statusP">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal" data-bs-original-title=""><i
                            class="fa fa-times"></i> Cerrar</button>
                    <button type="button" id="btnGuardar" class="btn btn-primary"><i class="fa fa-check"></i>
                        Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <!-- Zero Configuration  Starts-->
                        <div class="col-sm-12">
                            <div class="card ">
                                <!-- <div class="card-header pb-0"> -->
                                <h2>Ciclo Escolar</h2>
                                <h5>Registre y Busque Ciclos Escolares </h5>
                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="btn-agregar-Periodo btnAgregarP">
                                            <!-- .//data-toggle="modal" despliega el modal/ data-target="#modal-agregar-alumno" referencia por medio de id el modal a desplegar/data-dismiss="modal" esconde modales activos//data-toggle="modal"  data-target="#modal-agregar-alumno" data-dismiss="modal"-->
                                            <button type="button" id="btnAgregarP" class="btn btn-info btn-sm mb-4"
                                                data-toggle="modal" data-target="#modal-agregar-periodo"><i
                                                    class=""></i> Registrar</button>
                                        </div>
                                    </div>
                                </section>
                                <!-- </div> -->

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="basic-1">
                                            <thead>
                                                <tr>
                                                    <th>Periodo</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>

                                            <!-- <tbody id="tablaPER">
                 
                 </tbody> -->
                                        </table>
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

</body>
<?php
include '../includes/footer.php';
?>

<script src="js/Periodo.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>