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

                                    <h4 class="card-title mt-3" color="#ffffff00;">Asignar Calificación</h4>
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

                                    


                                        <div class="row">
                                            <div class="col-sm-12 text-center mt-4">
                                                <img src="../assets/images/ejemplos/xxlsx_icon.png"
                                                    style="width: 300px; border-radius: 3rem;" alt="">
                                            </div>
                                            <label for="file_imagee" style="margin-top: 10px;"><i
                                                    class="fa fa-file-archive-o" aria-hidden="true"></i>
                                                Subir Archivo
                                                Excel</label>
                                            <!-- g--------------------------- -->
                                            <input type="file" style="margin-top: 10px; width: 400px;" id="file_image"
                                                accept=".xlsx,.xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"
                                                class="form-control input-file">
                                            <!-- g--------------------------- -->
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-center mt-5">
                                                <button type="button" class="btn btn-primary btn-lg"
                                                    id="btncargarM">Cargar <i class="fa-solid fa fa-check"></i></button>
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
<script src="js/cargar_materias.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>