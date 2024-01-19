<?php
include '../includes/head.php';
include '../includes/Jefatura.php';
?>

<!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
<!-- <link rel="stylesheet" href="../assets/css/index-style.css"> -->

<head>
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
                                <h2>Ingreso de  Estudiantes</h2>
                                <h5>Registra estudiantes por medio de un excel</h5>
                                <section class="content">
                                    <div class="container-fluid">
                                    <div class="mb-4 row" id='Ex'>
    <h5 style="margin-bottom: -60px; margin-left: 40px; text-align: center;" class="col-sm-12">
        <!-- <i class="fa fa-info" aria-hidden="true"></i> Cargar Archivo -->
    </h5>
</div>

                                        <div class="form-outline text-center"
                                            style="display: flex; flex-direction: column; align-items: center;">
                                            <div class="mb-6 row">
                                                <img src="../assets/images/ejemplos/xxlsx_icon.png"
                                                    style="width: 300px; border-radius: 3rem;" alt=""
                                                    title="Aquí Podras Subir Tus Archivos Excel Para Guardar Los Datos de Tus Alumnos">
                                            </div>
                                            <label for="file_imagee" style="margin-top: 10px;"><i
                                                    class="fa fa-file-archive-o" aria-hidden="true"></i> Subir Archivo
                                                Excel</label>
                                            <input type="file" style="width: 400px; " id="file_image"
                                                accept=".xlsx,.xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"
                                                class="form-control input-file">
                                        </div>
                                    </div>

                                    <div class="text-center mt-5">
                                        <button type="button" class="btn btn-primary btn-lg" id="btncargarM">Cargar <i
                                                class="fa-solid fa-arrows-rotate"></i></button>
                                    </div>

                                    <!-- <div class="text-left mt-3">

                                        <button type="button"  id="btnDescargarPlantilla"
                                            class="btn btn-danger btn-lg">
                                            plantilla</button>

                                    </div> -->
                                </section>
                                <!-- </div> -->

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

<script src="../Jefatura/js/Carga_masiva.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>