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
    <link href="assets/css/styleMisApuestas.css" rel="stylesheet" type="text/css" media="screen">
    
    <!--JS-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./assets/css/stle.css" type="text/css"/>
</head>
<body>
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
                <a class="nav-link separacion" style="color: #00B9FF;">Última Apuesta</a>
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

if (isset($_POST['borrarApuesta'])){
  setcookie('codigoEventoApostado', "", time()-3600);
  setcookie('seleccionCuotaApostada', "", time()-3600); 
  setcookie('cantidadEventoApostado', "", time()-3600); 
  setcookie('gananciasEventoApostado', "", time()-3600);
  setcookie('tipoApuesta', "", time()-3600); 
  echo("<meta http-equiv='refresh' content='1'>");
}

// Cógido web de la página donde accederemos a ver las apuestas seleccionadas

?>

<section id="banner">
  <div class="capaoscuraBanner1 text-color3">
    <div class="formato-texto">
      <h1 class="tituloBanner1">Última Apuesta</h1> 
        <form method='post' action="misApuestas.php">
          <input name="borrarApuesta" class="crearApuesta" type="submit" value="Cerrar TODAS las apuestas" />
        </form>
    </div>
  </div>
</section>

<section id="tablasEventos">
    <?php
          if (isset($_COOKIE['codigoEventoApostado']) && isset($_COOKIE['cantidadEventoApostado']) && isset($_COOKIE['gananciasEventoApostado']) && isset($_COOKIE['tipoApuesta']) && isset($_COOKIE['seleccionCuotaApostada'])){
            $tipoApuesta = $_COOKIE['tipoApuesta'];
            if ($tipoApuesta == 'Simple'){
              $codigoEventoApostado = $_COOKIE['codigoEventoApostado'];
              $seleccionCuotaApostada = $_COOKIE['seleccionCuotaApostada'];
              $cantidadEventoApostado = $_COOKIE['cantidadEventoApostado'];
              $gananciasEventoApostado = $_COOKIE['gananciasEventoApostado'];
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
                      <td><?= $listaEventos[$codigoEventoApostado]->getFechaEvento(); ?></td> <!-- Mostramos la fecha del evento seleccionado -->
                      <td>
                          <!-- Mostramos el logo / bandera nacionalidad de los equipos -->
                          <?php if (($listaEventos[$codigoEventoApostado]->getTipoEvento() == "Futbol") || ($listaEventos[$codigoEventoApostado]->getTipoEvento() == "Basquet")){ ?>
                              <img style="width:35px;height:35px;" src="./assets/img/<?= $listaEventos[$codigoEventoApostado]->getLogoEquipoLocal(); ?>"><br>
                              <img style="width:35px;height:35px;" src="./assets/img/<?= $listaEventos[$codigoEventoApostado]->getLogoEquipoVisitante(); ?>">
                          <?php } else { ?>
                              <img style="width:35px;height:25px;" src="./assets/img/<?= $listaEventos[$codigoEventoApostado]->getNacionalidadEquipoLocal(); ?>"><br><br>
                              <img style="width:35px;height:25px;" src="./assets/img/<?= $listaEventos[$codigoEventoApostado]->getNacionalidadEquipoVisitante(); ?>">
                          <?php } ?>
                      </td>
                      <td><?= $listaEventos[$codigoEventoApostado]->getNombreEquipoLocal(); ?> <br> <?= $listaEventos[$codigoEventoApostado]->getNombreEquipoVisitante(); ?></td>  <!-- Mostramos los nombres del equipo local y visitante -->
                      <?php
                          if ($seleccionCuotaApostada == 1){?><td><?= $listaEventos[$codigoEventoApostado]->getNombreEquipoLocal(); ?></td><?php } // Si la seleccion es la cuota es 1, mostramos el nombre del equipo local
                          elseif ($seleccionCuotaApostada == "X"){?><td>Empate</td><?php } // Si la seleccion es la cuota es X, mostramos empate
                          elseif ($seleccionCuotaApostada == 2){?><td><?= $listaEventos[$codigoEventoApostado]->getNombreEquipoVisitante(); ?></td><?php } // Si la seleccion es la cuota es 2, mostramos el nombre del equipo visitante
                      ?>
                      <?php
                          if ($seleccionCuotaApostada == 1){?><td><?= $listaEventos[$codigoEventoApostado]->getCuotaEquipoLocal(); ?></td><?php } // Si la seleccion de la cuota es 1, mostramos la cuota del equipo local
                          elseif ($seleccionCuotaApostada == "X"){?><td><?= $listaEventos[$codigoEventoApostado]->getCuotaEmpate(); ?></td><?php } // Si la seleccion de la cuota es X, mostramos la cuota del empate
                          elseif ($seleccionCuotaApostada == 2){?><td><?= $listaEventos[$codigoEventoApostado]->getCuotaEquipoVisitante(); ?></td><?php } // Si la seleccion de la cuota es 2, mostramos la cuota del equipo visitante
                      ?>
                      <td><?= $cantidadEventoApostado; ?>€</td> <!-- Mostramos la cantidad apostada -->
                      <?php
                          if ($seleccionCuotaApostada == 1){?><td><?= $gananciasEventoApostado ?>€</td><?php } // Si la seleccion de la cuota es 1, multiplicamos la cuota local por la cantidad apostada y mostramos
                          elseif ($seleccionCuotaApostada == "X"){?><td><?= $gananciasEventoApostado ?>€</td><?php } // Si la seleccion de la cuota es X, multiplicamos la cuota del empate por la cantidad apostada y mostramos
                          elseif ($seleccionCuotaApostada == 2){?><td><?= $gananciasEventoApostado ?>€</td><?php } // Si la seleccion de la cuota es 2, multiplicamos la cuota visitante por la cantidad apostada y mostramos  
                      ?>
                  </tr>
                  <tr>
                      <td colspan="7">
                        <form method='post' action="misApuestas.php">
                          <input name="borrarApuesta" class="cerrarApuesta" type="submit" value="CERRAR APUESTA" />
                        </form>
                      </td>
                  </tr>
              </table>
              <br><br>
              
            <?php } 

              // Si tenemos las variables cantidadApostadaCombinada y cuotaTotalCombinada (del fichero seleccionApuesta.php)
              else if ($tipoApuesta == 'Combinada'){
                $codigoEventoApostado = unserialize($_COOKIE['codigoEventoApostado']);
                $cuotaApostadaIndiv = unserialize($_COOKIE['cuotaApostadaIndv']);
                $cuotaTotalCombinada = $_COOKIE['seleccionCuotaApostada'];
                $cantidadApostadaCombinada = $_COOKIE['cantidadEventoApostado'];
                $gananciasApuesta = $_COOKIE['gananciasEventoApostado']; ?>
                <br><br>
                <table>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Cuota</th>
                    <th>Cantidad Apostada</th>
                    <th>Ganancias Potenciales</th>
                  </tr>
                  <tr>
                      <td>
                          <?php foreach ($codigoEventoApostado as $codigo=>$evento){ ?> <!-- Recorremos todos los eventos seleccionados y mostramos su fecha evento en la misma celda -->
                              <?= $codigoEventoApostado[$codigo]->getFechaEvento(); ?><br>
                          <?php } ?>
                      </td>
                      <td>
                          <?php foreach ($codigoEventoApostado as $codigo=>$evento){ ?> <!-- Recorremos todos los eventos seleccionados y mostramos el nombre del equipo local y visitante en la misma celda -->
                              <?= $codigoEventoApostado[$codigo]->getNombreEquipoLocal(); ?> - <?= $codigoEventoApostado[$codigo]->getNombreEquipoVisitante(); ?><br>
                          <?php } ?>
                      </td>
                      <td>
                          <?php
                              foreach ($codigoEventoApostado as $codigo=>$evento){ // Recorremos todos los eventos seleccionados y mostraremos la seleccion del evento, en función de si es 1-X-2, en la misma celda
                                  if ($cuotaApostadaIndiv[$codigo] == 1){ echo $codigoEventoApostado[$codigo]->getNombreEquipoLocal();?><br><?php }
                                  elseif ($cuotaApostadaIndiv[$codigo] == "X"){echo "Empate";?><br><?php }
                                  elseif ($cuotaApostadaIndiv[$codigo] == 2){ echo $codigoEventoApostado[$codigo]->getNombreEquipoVisitante();?><br><?php }
                              }
                          ?>
                      </td>
                      <td><?php echo $cuotaTotalCombinada ?></td> <!-- Mostramos la cuota total de la combinada -->
                      <td><?php echo $cantidadApostadaCombinada ?>€</td> <!-- Mostramos la cantidad apostada en la combinada -->
                      <td><?php echo $gananciasApuesta ?>€</td> <!-- Mostramos las ganancias totales multiplicando la cantidad apostada por la cuota total -->
                  </tr>
                  <tr>
                      <td colspan="7">
                        <form method='post' action="misApuestas.php">
                          <input name="borrarApuesta" class="cerrarApuesta" type="submit" value="CERRAR APUESTA" />
                        </form>
                      </td>
                  </tr>
          <?php } ?>

                  
          </table>
          <br><br>


          <?php } ?>
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

