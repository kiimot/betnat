<!DOCTYPE html PUBLIC>
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
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen">
    
    <!--JS-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</head>

<!-- Cógido web de la página principal -->
<!-- Incluimos la cabecera -->
<?php require_once './views/cabecera.php';

// Iniciamos las SESSIONES
session_start();

//CREAR SESSIONES SI NO EXISTEN: Creamos la variable de sesion si no existen aún, cada sessión será un array llamados 'eventos' (donde almacenaremos los eventos seleccionados)
// y 'seleccionEventos' (donde almacenaremos la opción que ha escogido de esa apuesta, 1-X-2)
if (!isset($_SESSION['eventos']) && !isset($_SESSION['seleccionEventos'])){
    $_SESSION['eventos'] = [] ;
    $_SESSION['seleccionEventos'] = [] ; 
}

// En el caso de que esten creadas las dos sessiones.
// Si hemos recogido las variables 'evento' (recogeremos el código del evento) y 'seleccionEvento' (recogeremos la opcion que se ha escogido, 1-X-2), del formulario de eventos
else{
    if (isset($_POST['evento']) && isset($_POST['seleccionEvento'])){
        $eventoSeleccionado = $listaEventos[$_POST['evento']];              // Como tenemos el array de eventos disponibles con diccionario cuya clave es el código del evento, buscamos el evento (objeto) que ha seleccionado y lo metemos en la variable eventoSeleccionado   
        $seleccionEvento = $_POST['seleccionEvento'];                       // Guardaremos la seleccion  del evento (1-X-2) en la variable seleccionEvento                          
        $_SESSION['eventos'][$_POST['evento']]= $eventoSeleccionado;        // Metemos el objeto eventoSeleccionado en la session 'eventos' con una clave de diccionario, que será el código del evento seleccionado (así, buscando por código encontraremos los eventos seleccionados)      
        $_SESSION['seleccionEventos'][$_POST['evento']]= $seleccionEvento;  // Metemos la opcion del evento (1-X-2), en la sesion 'seleccionEventos' con la misma clave de diccionario que la session 'eventos', para que identifiquemos la opción de cada evento seleccionado
    }
}

// En resumen, vamos a tener dos arrays con las mismas claves de diccionario para almacenar el objeto evento y tambien que cuota hemos marcado.
// Ejemplo: "F01" => Objeto EventoSeleccionado / "F01" => 1
// Importante: NO se podrán seleccionar dos veces la misma apuesta ni diferentes opciones de la misma apuesta.    

?>

<body>

<!-- Barra de navegación -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-color1">
        <div class="container-lg">
          <a class="navbar-brand fs-3" href="#"><img style="width: 150px;" src="./assets/img/logo.png"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link separacion" style="color: #00B9FF;">Inicio</a>
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

<!-- Banner donde tenemos el titulo de COMBINADAS DE FÚTBOL -->
<section id="bannerIndex">
  <div class="capaOscuraBannerIndex text-color3">
    <div class="container-lg">
      <span class="formatoTextoBannerIndex">
        <h1 class="tituloBannerIndex">COMBINADAS DE FÚTBOL</h1>
        <h6 class="textoBannerIndex">¡Bonificación de hasta el 70% en cumuladas ganadoras. Combina<br>hasta 25 variables del mismo partido y en la misma apuesta!</h6>
        <a href="tablaEventos.php"><button class="botonCrearApuestaIndex">Crea tu apuesta</button></a>
      </span>
    </div>
  </div>
</section>

<!-- Seccion 1, donde se encuentra la apuesta simple de tenis -->
<section id="seccion1Index">
  <div class="capaOscuraSeccion1Index text-color3">
    <span class="formatoTextoSeccion1Index">
      <div class="estructuraTextoSeccion1Index">
        <div>
          <h1 class="tituloSeccion1Index">APUESTA SIMPLE</h1>
          <h6 class="textoSeccion1Index">Jue 5 Mayo, 05:10</h6>
          <h6 class="textoSeccion1Index"><img class="escudoIndex" src="./assets/img/rusia.png">Daniil Medvedev</h6>
          <h6 class="textoSeccion1Index"><img class="escudoIndex" src="./assets/img/españa.png">Rafael Nadal</h6>
        </div>
        <div>
          <h6 class="botonesSeleccionesIndex">
            <form action='seleccionApuesta.php' method='get'>
                <input type="hidden" name="codigoEvento" value="T01">
                <input type="hidden" name="seleccionEvento" value="1">
                <input class="botonCuotaIndex" type="submit" name="eventoBanner1" value="1.66">    
            </form>
            <form action='seleccionApuesta.php' method='get'>
                <input type="hidden" name="codigoEvento" value="T01">
                <input type="hidden" name="seleccionEvento" value="2">
                <input class="botonCuotaIndex" type="submit" name="eventoBanner2" value="2.20">    
            </form>
          </h6>
        </div>
    </div>
    </span>
  </div>
</section>

<!-- Seccion 2, donde se encuentra la imagen simple de 18 puntos de ventaja de basquet -->
<section id="seccion2Index">
  <div class="capaOscuraSeccion2Index text-color3"></div>
</section>

<!-- En este DIV, donde se encuentran los textos centrales de las secciones 2 y 3 -->
<div class="textoSeccion2y3Index">
  <div class="textoSeccion2Index">
    <h6 class="tituloIzquierdaIndex">Oferta de 18 puntos de ventaja - Baloncesto</h6>
    <h7 class="textoIzquierdaIndex">Si su jugador es sustituido antes del descanso,<br class="lgIndex"> le devolveremos
      el importe de su apuesta como<br  class="lgIndex"> créditos de apuesta en mercados seleccionados.</h7>
  </div>
  <div class="textoSeccion3Index">
    <h6 class="tituloDerechaIndex">Fútbol - Garantía por sustitución</h6>
    <h7 class="textoDerechaIndex">Sus apuestas sencillas se pagarán si su equipo obtiene<br  class="lgIndex"> 18 puntos
      de ventaja. Para apuestas múltiples, la selección<br  class="lgIndex"> se determinará
     como ganadora.</h7>
  </div>
</div>

<!-- Seccion 3, donde se encuentra la imagen simple de garantia por sustitución -->
<section id="seccion3Index">
  <div class="capaOscuraSeccion3Index text-color3"></div>
</section>

<!-- FOOTER, donde tendremos las imagenes laterales de la izquierda, el texto central y las imagenes laterales de la derecha -->
<footer class="footerIndex">
  <div class="zonaFooterIzqIndex">
    <img class="footerIzq1Index" src="./assets/img/footerIzq1.png"><br>
    <img class="footerIzq2Index" src="./assets/img/footerIzq2.png"><br>
    <img class="footerIzq3Index" src="./assets/img/footerIzq3.png"><br>
    <img class="footerIzq4Index" src="./assets/img/footerIzq4.png">
    <img class="footerIzq5Index" src="./assets/img/footerIzq5.png">
    <img class="footerIzq6Index" src="./assets/img/footerIzq6.png">
  </div>
  <div class="zonaFooterCentroIndex">
    Al acceder, seguir utilizando o navegar en este sitio Web, el cliente acepta que utilicemos ciertas cookies
    de navegación para mejorar su experiencia con nosotros. Betnat solo utilizará cookies que mejoren su 
    experiencia y no aquellas que interfieran con su privacidad.
    <div class="enlacesIndex">Política de privacidad   |   Política de cookies   |   Reglas y Regulaciones   |   Términos y condiciones  |   Juega con responsabilidad</div>
    <div class="copyrightIndex">Copyright © 2022 Betnat. Todos los derechos reservados.</div>
  </div>
  <div class="zonaFooterDerIndex">
    <img class="footerDer1Index" src="./assets/img/footerDer1.png">
    <img class="footerDer2Index" src="./assets/img/footerDer2.png"><br>
    <img class="footerDer3Index" src="./assets/img/footerDer3.png"><br>
    <img class="footerDer4Index" src="./assets/img/footerDer4.png">
  </div>
</footer>

</body>

</html>
