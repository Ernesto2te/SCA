<?php
include '../includes/head.php';
include '../includes/Jefatura.php';
?>
<!-- <link rel="stylesheet" href="../assets/css/KARDEX.css"> -->
<link rel="stylesheet" href="../assets/css/nueva_hoja.css">

<body>
    <div class="page-wrapper compact-wrapper "  id="pageWrapper">
        <div class="page-body-wrapper">
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="container py-4">
                                <div class="text-center">
                                    <!-- <img src="../assets/images/ejemplos/libro.png" alt="" width="120px"> -->
                                    <h2>Boleta Parcial de Calificaciones</h2>
                                </div>
                            </div>
                            <div class="container mt-5">
                                <form>
                                    <div class="row">
                                        <div class="col-md-3 mt-2" style="text-align:right;">
                                            <label><b>Buscar Boleta</b></label>
                                        </div>
                                        <div class="col-md-5 mt-1">
                                            <div class="form-outline">
                                                <input type="text" placeholder="Inserte Matrícula"
                                                    class="form-control form-control-lg" id="buscartxt">
                                                <label class="form-label" for="formControlLg">Matrícula del
                                                    estudiante</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-1">
                                            <button type="button" id="buscarM"
                                                class="btn form-control btn-info btn-lg"><i
                                                    class="fa-solid fa-magnifying-glass"></i> Buscar </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>
                        </div>

                        <div class="card" id="tabla"  >
                            <div class="card-body">
                                <div class="container">


                                <div class="mb-3 row container table-responsive" style="margin-top:20px;">
                                <div class="mb-3 row" style="margin-top:20px;">
                                    <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                        <table class="display dataTable no-footer" id="cargastable" role="grid" aria-describedby="basic-1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 158.238px;">Nombre(s)</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 248.188px;">Matriula</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 248.188px;">Período</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 117.125px;">PDF</th>
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
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include '../includes/footer.php';
?>
<script src="js/kardex.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>