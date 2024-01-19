<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ADE PDF Maker</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="../assets/css/mdb.min.css" />
</head>
<body>
      <!--Main Navigation-->
  <header>
    <style>
      #intro {
        height: 100vh;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        background-color: white!important;
      }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg d-none d-lg-block" style="z-index: 2000; ">
      <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand nav-link" target="_blank" href="">
          <img src="../assets/images/ejemplos/header_letras.png" alt=""  width="30%">
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item active">
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container d-flex align-items-center justify-content-center text-center h-100" >
          <div class="text-white">
            <img src="../assets/images/pdf.png" alt="" width="250px">
            <h1 class="mb-3">¡Alto ahí!</h1>
            <h5 class="mb-4">No tienes acceso a esta pagina o tu token ha expirado</h5>
            <p class="mb-4">
                <i>
                <?php
                //hora de mexico
                date_default_timezone_set('America/Mexico_City');
                //fecha actual
                $fecha_actual = date("Y-m-d H:i:s");
                echo "Consulta : $fecha_actual";
                ?>
                </i>
    </p>
    <a class="btn btn-outline-light btn-lg m-2" href="../index.php" type="button"
              rel="nofollow">Cerrando en <span id="count-timeout">0</span> </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->


    <!-- MDB -->
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="../assets/js/countimer.js"></script>
</body>
</html>