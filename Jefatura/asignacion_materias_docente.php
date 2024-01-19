<?php
include '../includes/head.php';
include '../includes/Jefatura.php';
?>

<head>
    <!-- <link rel="stylesheet" href="../assets/css/asignacion_docentes.css"> -->
    <link rel="stylesheet" href="../assets/css/nueva_hoja.css">
    <!-- Biblioteca de jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Biblioteca de jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

</head>

<body>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <!-- Zero Configuration Starts -->
                        <div class="col-sm-12">
                            <div class="container py-4">
                                <div class="card shadow-2-strong" style="border-radius: 1rem;">

                                    <h4 class="card-title mt-3" color="#ffffff00;">Asignar Materias Docente</h4>
                                    <h5 class="card-title mt-3" color="#ffffff00;">En este modulo podra asignar las materias a impartir a los docentes. Podra asignar las materias al profesor segun sea el ciclo y el grupo en el que se impartira la materia.</h5>
                                    <form action="" method="" id="fechas" enctype="multipart/form-data">
                                        <input type="hidden" name="secure" id="secure">

                                        <div class="row" id="conjuntoin">
                                            <div class="col-md-5">
                                                <h5><i class="fa fa-file-text-o" aria-hidden="true"></i> Ciclo</h5>
                                                <select class="form-select form-control-lg custom-select"
                                                    id="selectPeriodo">
                                                    <option value="" disabled selected>Seleccione ciclo escolar</option>
                                                    <!-- agregar más opciones según necesidad -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row" id="conjuntoin3">
                                            <div class="col-md-5">
                                                <h5><i class="fa fa-file-text-o" aria-hidden="true"></i> Docente</h5>
                                                <select class="form-select form-control-lg custom-select"
                                                    id="selectDocente">
                                                    <option value="" disabled selected>Seleccione Profesor</option>
                                                    <!-- agregar más opciones según necesidad -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row" id="conjuntoin2">
                                            <div class="col-md-5">
                                                <h5><i class="fa fa-book" aria-hidden="true"></i> Materia</h5>
                                                <select class="form-select form-control-lg custom-select"
                                                    id="selectMateria">
                                                    <option value="" disabled selected>Seleccione Materia</option>
                                                    <!-- agregar más opciones según necesidad -->
                                                </select>
                                            </div>

                                            <div class="col-md-5">
                                                <h5><i class="fa fa-book" aria-hidden="true"></i> Grupo</h5>
                                                <select class="form-select form-control-lg custom-select"
                                                    id="selectGrupo">
                                                    <option value="" disabled selected>Seleccione un Grupo...</option>
                                    
                                                </select>
                                            </div>
                                        </div>


                                        <!-- <div class="col-md-5">
                                                <h5><i class="fa fa-book" aria-hidden="true"></i> Semestre</h5>
                                                <select class="form-select form-control-lg custom-select"
                                                    id="selectSemestre">
                                                    <option value="" disabled selected>Seleccione Semestre...</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>
                                                    <option>7</option>
                                                    <option>8</option>
                                                    <option>9</option>
                                                    <option>10</option>
                                                    <option>11</option>
                                                    <option>12</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-sm-12 text-center mt-5">
                                                <button type="button" class="btn btn-primary btn-lg"
                                                    id="btnGuardarM">Cargar <i class="fa-solid fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration Ends -->
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

<?php
include '../includes/footer.php'
?>
<!-- <script src="js/cargar_materias.js"></script> -->

<script src="js/materias_docente.js"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>