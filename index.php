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
    <link href="assets/css/styleIndex.css" rel="stylesheet" type="text/css" media="screen">
    
    <!--JS-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</head>

<!-- Cógido web de la página principal -->
<!-- Incluimos la cabecera -->
<?php require_once './views/cabecera.php';

// Iniciamos las SESSIONES
session_start();

// BORRADO SESSIONES SI HEMOS APOSTADO: Vemos si hemos recogido la variable 'comeBack' de las páginas resguardoApuestaCombinada.php o resguardoApuesta.php, 
// y si hay algún evento en el array de la sesión, eliminaremos la variable 'comeBack' y vacíaremos el array 'evento' y el array 'seleccionEventos' que hay en las sesiones. 
if (isset($_GET['comeBack'])){
    if (count($_SESSION['eventos']) >= 1){
        unset($_GET['comeBack']); 
    }
}

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

<section id="banner">
  <div class="capaoscuraBanner1 text-color3">
    <div class="container-lg">
      <span class="formato-texto">
        <h1 class="tituloBanner1">COMBINADAS DE FÚTBOL</h1>
        <h6 class="textoBanner1">¡Bonificación de hasta el 70% en cumuladas ganadoras. Combina<br>hasta 25 variables del mismo partido y en la misma apuesta!</h6>
        <a href="tablaEventos.php"><button class="crearApuesta">Crea tu apuesta</button></a>
      </span>
    </div>
  </div>
</section>


<section id="seccion1">
  <div class="capaoscuraSeccion1 text-color3">
    <span class="formato-texto-seccion1">
      <h1 class="tituloSeccion1">COMBINADAS SIMPLE</h1>
      <h6 class="textoSeccion1">Jue 5 Mayo, 05:10</h6>
      <h6 class="textoSeccion1"><img class="escudo" src="./assets/img/rusia.png">Daniil Medvedev</h6>
      <h6 class="textoSeccion1"><img class="escudo" src="./assets/img/españa.png">Rafael Nadal</h6>
      <h6 class="botonesSelecciones">
        <form action='seleccionApuesta.php' method='get'>
            <input type="hidden" name="codigoEvento" value="T01">
            <input type="hidden" name="seleccionEvento" value="1">
            <input class="botonSeleccion1" type="submit" name="eventoBanner1" value="1.66">    
        </form>
        <form action='seleccionApuesta.php' method='get'>
            <input type="hidden" name="codigoEvento" value="T01">
            <input type="hidden" name="seleccionEvento" value="2">
            <input class="botonSeleccion1" type="submit" name="eventoBanner2" value="2.20">    
        </form>
      </h6>
    </span>
  </div>
</section>

<section id="seccion2">
  <div class="capaoscuraSeccion2 text-color3"></div>
</section>

<div class="textoSec2y3">
  <div class="seccion2">
    <h6 class="tituloIzquierda">Oferta de 18 puntos de ventaja - Baloncesto</h6>
    <h7 class="textoIzquierda">Si su jugador es sustituido antes del descanso,<br> le devolveremos
      el importe de su apuesta como<br> créditos de apuesta en mercados seleccionados.</h7>
  </div>
  <div class="seccion3">
    <h6 class="tituloDerecha">Fútbol - Garantía por sustitución</h6>
    <h7 class="textoDerecha">Sus apuestas sencillas se pagarán si su equipo obtiene<br> 18 puntos
      de ventaja. Para apuestas múltiples, la selección<br> se determinará
     como ganadora.</h7>
  </div>
</div>

<section id="seccion3">
  <div class="capaoscuraSeccion3 text-color3"></div>
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
