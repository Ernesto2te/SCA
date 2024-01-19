<?php
include '../includes/head.php';
include '../includes/jefatura.php';
?>
<link rel="stylesheet" href="../assets/css/menu_asignacion.css">

<div class="page-body">
    <div class="container" style="padding: 0; height: 80px;"></div>
    <div class="container">
        <div class="text-center">
            <h1>Menú Profesores</h1>
        </div>
    </div>
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card menu-card">
                    <div class="menu-option">
                        <a href="agregar_profesor.php"><img class="img-fluid"
                                src="../assets/images/ejemplos/docentes.svg" alt="Docentes"></a>
                        <div class="menu-option-content">
                            <h3>Agregar Profesores</h3>
                            <p>Inserte al sistema informacion general de los docentes</p>
                            <a href="agregar_profesor.php">Ir a agregar profesores</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card menu-card">
                    <div class="menu-option">
                        <a href="asignacion_estudiantee.php"><img
                                src="../assets/images/ejemplos/estudiantes.svg" alt="Estudiantes"></a>
                        <div class="menu-option-content">
                            <h3>Asignar usuario</h3>
                            <p>Asigne un usuario a un profesor para que pueda acceder al sistema</p>
                            <a href="asignacion_estudiantee.php">Ir a asignar usuario</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php'
?>

