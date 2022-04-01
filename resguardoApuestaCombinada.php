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
    <link href="assets/css/styleResguardoApuestaCombinada.css" rel="stylesheet" type="text/css" media="screen">
    
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
      <h1 class="tituloBanner1">Resguardo Apuesta Combinada</h1>     
        <form method='get' action="tablaEventos.php"> <!-- Formulario para recoger el valor del input, nos llevará a index.php (nos servira para vaciar los arrays de las sessiones) -->
            <input name="comeBack" class="crearApuesta" type="submit" value="Realizar mas apuestas" /> <!-- Cuando pulsemos el input, el valor será Realizar mas apuesta -->
        </form>
    </div>
  </div>
</section>

<section id="tablasEventos">
    <?php
        // Si tenemos las variables cantidadApostadaCombinada y cuotaTotalCombinada (del fichero seleccionApuesta.php)
        if (isset($_GET['cantidadApostadaCombinada']) && isset($_GET['cuotaTotalCombinada'])){
            $cantidadApostadaCombinada = $_GET['cantidadApostadaCombinada']; // Guardamos la cantidadApostadaCombinada en la variable cantidadApostadaCombinada
            $cuotaTotalCombinada = $_GET['cuotaTotalCombinada'];    // Guardamos la cuotaTotalCombinada, en la variable cuotaTotalCombinada
            setcookie('codigoEventoApostado', serialize($_SESSION['eventos']) , time()+3600);
            setcookie('cuotaApostadaIndv', serialize($_SESSION['seleccionEventos']), time()+3600);
            setcookie('tipoApuesta','Combinada', time()+3600);
            setcookie('gananciasEventoApostado', $cantidadApostadaCombinada*$cuotaTotalCombinada, time()+3600);
            setcookie('seleccionCuotaApostada', $cuotaTotalCombinada, time()+3600);
            setcookie('cantidadEventoApostado', $cantidadApostadaCombinada, time()+3600);
    ?>
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
                    <?php foreach ($_SESSION['eventos'] as $codigo=>$evento){ ?> <!-- Recorremos todos los eventos seleccionados y mostramos su fecha evento en la misma celda -->
                        <?= $_SESSION['eventos'][$codigo]->getFechaEvento(); ?><br>
                    <?php } ?>
                </td>
                <td>
                    <?php foreach ($_SESSION['eventos'] as $codigo=>$evento){ ?> <!-- Recorremos todos los eventos seleccionados y mostramos el nombre del equipo local y visitante en la misma celda -->
                        <?= $_SESSION['eventos'][$codigo]->getNombreEquipoLocal(); ?> - <?= $_SESSION['eventos'][$codigo]->getNombreEquipoVisitante(); ?><br>
                    <?php } ?>
                </td>
                <td>
                    <?php
                        foreach ($_SESSION['eventos'] as $codigo=>$evento){ // Recorremos todos los eventos seleccionados y mostraremos la seleccion del evento, en función de si es 1-X-2, en la misma celda
                            if ($_SESSION['seleccionEventos'][$codigo] == 1){ echo $_SESSION['eventos'][$codigo]->getNombreEquipoLocal();?><br><?php }
                            elseif ($_SESSION['seleccionEventos'][$codigo] == "X"){echo "Empate";?><br><?php }
                            elseif ($_SESSION['seleccionEventos'][$codigo] == 2){ echo $_SESSION['eventos'][$codigo]->getNombreEquipoVisitante();?><br><?php }
                        }
                    ?>
                </td>
                <td><?php echo $cuotaTotalCombinada;  ?></td> <!-- Mostramos la cuota total de la combinada -->
                <td><?php echo $cantidadApostadaCombinada; ?>€</td> <!-- Mostramos la cantidad apostada en la combinada -->
                <td><?php echo $cantidadApostadaCombinada*$cuotaTotalCombinada; ?>€</td> <!-- Mostramos las ganancias totales multiplicando la cantidad apostada por la cuota total -->
            </tr>
    <?php } 
        $_SESSION['eventos'] = [] ;
        $_SESSION['seleccionEventos'] = [] ;        
    ?>

            
    </table>
    <br><br>

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

