<html>
<head>
<title>BETNAT</title>
    <!-- <meta http-equiv="refresh" content="2"> -->
    <meta charset="UTF-8">
    <meta name="description" content="Plantilla web bootstrap">
    <meta name="keywords" content="Paraula1, Paraula2, Paraula3">
    <meta name="author" content="Nom autor">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styleResguardoApuesta.css" rel="stylesheet" type="text/css" media="screen">
    
    <!--JS-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./assets/css/stle.css" type="text/css"/>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-color1">
        <div class="container-lg">
          <a class="navbar-brand fs-3" href="./index.php"><img style="width: 150px;" src="./assets/img/logo.png"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link separacion" href="./index.php">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link separacion" href="./tablaEventos.php">Eventos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link separacion" href="./seleccionApuesta.php">Selecciones</a>
              </li>
              <li class="nav-item">
                <a class="nav-link separacion" href="./misApuestas.php">Última Apuesta</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</header>

<!-- Incluimos la cabecera -->
<?php require_once './views/cabecera.php';

// Iniciamos las SESSIONES
session_start();   

// Cógido web de la página donde accederemos a ver las apuestas seleccionadas

?>

<section id="banner">
  <div class="capaoscuraBanner1 text-color3">
    <div class="formato-texto">
      <h1 class="tituloBanner1">Resguardo Apuesta Simple</h1>     
        <form method='get' action="tablaEventos.php"> <!-- Formulario para recoger el valor del input, nos llevará a index.php (nos servira para vaciar los arrays de las sessiones) -->
            <input name="comeBack" class="crearApuesta" type="submit" value="Realizar mas apuestas" /> <!-- Cuando pulsemos el input, el valor será Realizar mas apuesta -->
        </form>
    </div>
  </div>
</section>

<section id="tablasEventos">
    <?php
        // Si tenemos las variables eventoAccion, seleccionCuota y la cantidad apostada (del fichero seleccionApuesta.php)
        if (isset($_GET['eventoAccion']) && isset($_GET['seleccionCuota']) && ($_GET['cantidadApostada'] >= 1)){
            $eventoAccion = $_GET['eventoAccion']; // Guardamos eventoAccion en la variable eventoAccion
            $seleccionCuota = $_GET['seleccionCuota']; // Guardamos seleccionCuota en la variable seleccionCuota
            $cantidadApostada = $_GET['cantidadApostada']; // Guardamos cantidadApostada en la variable cantidadApostada
            $gananciasPotenciales = 0;
            ?>
            <br><br>
            <table>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Cuota</th>
                    <th>Cantidad Apostada</th>
                    <th>Ganancias Potenciales</th>
                </tr>
                <tr>
                    <td><?= $listaEventos[$eventoAccion]->getFechaEvento(); ?></td> <!-- Mostramos la fecha del evento seleccionado -->
                    <td>
                        <!-- Mostramos el logo / bandera nacionalidad de los equipos -->
                        <?php if (($listaEventos[$eventoAccion]->getTipoEvento() == "Futbol") || ($listaEventos[$eventoAccion]->getTipoEvento() == "Basquet")){ ?>
                            <img style="width:35px;height:35px;" src="./assets/img/<?= $listaEventos[$eventoAccion]->getLogoEquipoLocal(); ?>"><br>
                            <img style="width:35px;height:35px;" src="./assets/img/<?= $listaEventos[$eventoAccion]->getLogoEquipoVisitante(); ?>">
                        <?php } else { ?>
                            <img style="width:35px;height:25px;" src="./assets/img/<?= $listaEventos[$eventoAccion]->getNacionalidadEquipoLocal(); ?>"><br><br>
                            <img style="width:35px;height:25px;" src="./assets/img/<?= $listaEventos[$eventoAccion]->getNacionalidadEquipoVisitante(); ?>">
                        <?php } ?>
                    </td>
                    <td><?= $listaEventos[$eventoAccion]->getNombreEquipoLocal(); ?> <br> <?= $listaEventos[$eventoAccion]->getNombreEquipoVisitante(); ?></td>  <!-- Mostramos los nombres del equipo local y visitante -->
                    <?php
                        if ($seleccionCuota == 1){?><td><?= $listaEventos[$eventoAccion]->getNombreEquipoLocal(); ?></td><?php } // Si la seleccion es la cuota es 1, mostramos el nombre del equipo local
                        elseif ($seleccionCuota == "X"){?><td>Empate</td><?php } // Si la seleccion es la cuota es X, mostramos empate
                        elseif ($seleccionCuota == 2){?><td><?= $listaEventos[$eventoAccion]->getNombreEquipoVisitante(); ?></td><?php } // Si la seleccion es la cuota es 2, mostramos el nombre del equipo visitante
                    ?>
                    <?php
                        if ($seleccionCuota == 1){?><td><?= $listaEventos[$eventoAccion]->getCuotaEquipoLocal(); ?></td><?php } // Si la seleccion de la cuota es 1, mostramos la cuota del equipo local
                        elseif ($seleccionCuota == "X"){?><td><?= $listaEventos[$eventoAccion]->getCuotaEmpate(); ?></td><?php } // Si la seleccion de la cuota es X, mostramos la cuota del empate
                        elseif ($seleccionCuota == 2){?><td><?= $listaEventos[$eventoAccion]->getCuotaEquipoVisitante(); ?></td><?php } // Si la seleccion de la cuota es 2, mostramos la cuota del equipo visitante
                    ?>
                    <td><?= $cantidadApostada; ?>€</td> <!-- Mostramos la cantidad apostada -->
                    <?php
                        if ($seleccionCuota == 1){?><td><?= $gananciasPotenciales = ($listaEventos[$eventoAccion]->getCuotaEquipoLocal()*$cantidadApostada); $gananciasPotenciales ?>€</td><?php } // Si la seleccion de la cuota es 1, multiplicamos la cuota local por la cantidad apostada y mostramos
                        elseif ($seleccionCuota == "X"){?><td><?= $gananciasPotenciales = ($listaEventos[$eventoAccion]->getCuotaEmpate()*$cantidadApostada); $gananciasPotenciales ?>€</td><?php } // Si la seleccion de la cuota es X, multiplicamos la cuota del empate por la cantidad apostada y mostramos
                        elseif ($seleccionCuota == 2){?><td><?= $gananciasPotenciales = ($listaEventos[$eventoAccion]->getCuotaEquipoVisitante()*$cantidadApostada); $gananciasPotenciales ?>€</td><?php } // Si la seleccion de la cuota es 2, multiplicamos la cuota visitante por la cantidad apostada y mostramos
                        $_SESSION['ultimaApuesta'] = "<h5>Last bet: Selection: SIMPLE Amount ".$cantidadApostada."  Pot. Win. ".$gananciasPotenciales."</h5>";
                        setcookie('codigoEventoApostado', $listaEventos[$eventoAccion]->getCodigoEvento(), time()+3600);
                        setcookie('seleccionCuotaApostada', $seleccionCuota, time()+3600); 
                        setcookie('cantidadEventoApostado', $cantidadApostada, time()+3600); 
                        setcookie('gananciasEventoApostado', $gananciasPotenciales, time()+3600);
                        setcookie('tipoApuesta','Simple', time()+3600);
                    ?>
                </tr>
            </table>
            <br><br>

            

        <?php } 
            $_SESSION['eventos'] = [] ;
            $_SESSION['seleccionEventos'] = [] ;
        ?>
    ?>
</section>


<section id="seccion2">
  <div class="capaoscuraSeccion2 text-color3"></div>
</section>











<footer>
  <div class="zonaFooterIzq">
    <img class="footerIzq1" src="./assets/img/footerIzq1.png"><br>
    <img class="footerIzq2" src="./assets/img/footerIzq2.png"><br>
    <img class="footerIzq3" src="./assets/img/footerIzq3.png"><br>
    <img class="footerIzq4" src="./assets/img/footerIzq4.png">
    <img class="footerIzq5" src="./assets/img/footerIzq5.png">
    <img class="footerIzq6" src="./assets/img/footerIzq6.png">
  </div>
  <div class="zonaFooterCentro">
    Al acceder, seguir utilizando o navegar en este sitio Web, el cliente acepta que utilicemos ciertas cookies
    de navegación para mejorar su experiencia con nosotros. Betnat solo utilizará cookies que mejoren su 
    experiencia y no aquellas que interfieran con su privacidad.
    <div class="enlaces">Política de privacidad   |   Política de cookies   |   Reglas y Regulaciones   |   Términos y condiciones  |   Juega con responsabilidad</div>
    <div class="copyright">Copyright © 2022 Betnat. Todos los derechos reservados.</div>
  </div>
  <div class="zonaFooterDer">
    <img class="footerDer1" src="./assets/img/footerDer1.png">
    <img class="footerDer2" src="./assets/img/footerDer2.png"><br>
    <img class="footerDer3" src="./assets/img/footerDer3.png"><br>
    <img class="footerDer4" src="./assets/img/footerDer4.png">
  </div>
</footer>

</body>

</html>

