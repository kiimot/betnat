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
    <link href="assets/css/styleTablaEventos.css" rel="stylesheet" type="text/css" media="screen">
    
    <!--JS-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
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
                <a class="nav-link separacion" style="color: #00B9FF;">Eventos</a>
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
        $_SESSION['eventos'] = [] ;
        $_SESSION['seleccionEventos'] = [] ; 
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
        //setcookie('TestCookie', $seleccionEvento, time()+3600);  /* expira en 1 hora */
        //echo $_COOKIE['TestCookie'];
        $_SESSION['eventos'][$_POST['evento']]= $eventoSeleccionado;        // Metemos el objeto eventoSeleccionado en la session 'eventos' con una clave de diccionario, que será el código del evento seleccionado (así, buscando por código encontraremos los eventos seleccionados)      
        $_SESSION['seleccionEventos'][$_POST['evento']]= $seleccionEvento;  // Metemos la opcion del evento (1-X-2), en la sesion 'seleccionEventos' con la misma clave de diccionario que la session 'eventos', para que identifiquemos la opción de cada evento seleccionado
    }
}

// En resumen, vamos a tener dos arrays con las mismas claves de diccionario para almacenar el objeto evento y tambien que cuota hemos marcado.
// Ejemplo: "F01" => Objeto EventoSeleccionado / "F01" => 1
// Importante: NO se podrán seleccionar dos veces la misma apuesta ni diferentes opciones de la misma apuesta.    

?>

<section id="banner">
  <div class="capaoscuraBanner1 text-color3">
    <div class="formato-texto">
      <h1 class="tituloBanner1">Eventos Destacados</h1>
      <a href="seleccionApuesta.php"><button class="crearApuesta"> <?php if (isset($_SESSION['eventos'])){ echo count($_SESSION['eventos'])." Selecciones"; }  ?></button></a>
    </div>
  </div>
</section>

<section id="tablasEventos">

    <!-- Aquí empezaremos a montar la tabla con TODOS los eventos disponibles -->
    <br><br>
    <table>
        <tr>
            <th colspan="3" class="titulo-tabla">Fútbol</th>
            <th class="numero-tabla">1</th>
            <th class="numero-tabla">X</th>
            <th class="numero-tabla">2</th>
        </tr>
        
        <?php
        foreach ($listaEventos as $evento ){ ?> <!-- Recorreremos todos los eventos disponibles, guardando cada uno en la variable $evento -->
            <?php if ($evento->getTipoEvento() == "Futbol") { ?>
            <tr>
                <td><?= $evento->getFechaEvento(); ?></td>  <!-- Mostramos la fecha del evento en la pantalla -->
                <td>
                    <img style="width:45px;height:45px;" src="./assets/img/<?= $evento->getLogoEquipoLocal(); ?>">  <!-- Mostraremos la imagen del logo del equipo local -->
                    <img style="width:45px;height:45px;" src="./assets/img/<?= $evento->getLogoEquipoVisitante(); ?>">  <!-- Mostraremos la imagen del logo del equipo visitante -->
                </td>
                <td>
                    <?= $evento->getNombreEquipoLocal(); ?><br> <!-- Mostramos el nombre del equipo local --> 
                    <?= $evento->getNombreEquipoVisitante(); ?></td> <!-- Mostramos el nombre del equipo visitante -->
                <td>
                    <form action='./tablaEventos.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                        <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                        <input type="hidden" name="seleccionEvento" value=1> <!-- Guardaremos en el input 'seleccionEvento' el valor 1, porque se habrá pulsado el 1 -->
                        <input type="submit" value="<?= $evento->getCuotaEquipoLocal(); ?>"> <!-- Mostramos en el submit el valor de la cuota 1 por pantalla -->
                    </form> 
                </td>
                <td>
                    <form action='./tablaEventos.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                        <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                        <input type="hidden" name="seleccionEvento" value="X"> <!-- Guardaremos en el input 'seleccionEvento' el valor X, porque se habrá pulsado el X -->
                        <input type="submit" value="<?= $evento->getCuotaEmpate(); ?>"> <!-- Mostramos en el submit el valor de la cuota X por pantalla -->
                    </form> 
                </td>                   
                <td>
                    <form action='./tablaEventos.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                        <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                        <input type="hidden" name="seleccionEvento" value=2> <!-- Guardaremos en el input 'seleccionEvento' el valor 2, porque se habrá pulsado el 2 -->
                        <input type="submit" value="<?= $evento->getCuotaEquipoVisitante(); ?>"> <!-- Mostramos en el submit el valor de la cuota 2 por pantalla -->
                    </form> 
                </td>
            </tr>
        <?php }} ?>
    </table>

    <br><br>
    <table>
        <tr>
            <th colspan="3" class="titulo-tabla">Basquet</th>
            <th class="numero-tabla">1</th>
            <th class="numero-tabla">2</th>
        </tr>
        
        <?php
        foreach ($listaEventos as $evento ){ ?> <!-- Recorreremos todos los eventos disponibles, guardando cada uno en la variable $evento -->
            <?php if ($evento->getTipoEvento() == "Basquet") { ?>
            <tr>
                <td><?= $evento->getFechaEvento(); ?></td>  <!-- Mostramos la fecha del evento en la pantalla -->
                <td>
                    <?php if (($evento->getTipoEvento() == "Futbol") || ($evento->getTipoEvento() == "Basquet")){ ?>        <!-- Si el tipo de evento es Fútbol o Basquet -->
                        <img style="width:45px;height:45px;" src="./assets/img/<?= $evento->getLogoEquipoLocal(); ?>">  <!-- Mostraremos la imagen del logo del equipo local -->
                        <img style="width:45px;height:45px;" src="./assets/img/<?= $evento->getLogoEquipoVisitante(); ?>">  <!-- Mostraremos la imagen del logo del equipo visitante -->
                    <?php } else { ?>  <!-- En caso que no sea ni futbol ni basquet -->                                                     
                        <img style="width:45px;height:35px;" src="./assets/img/<?= $evento->getNacionalidadEquipoLocal(); ?>"> <!-- Mostraremos la bandera del país del tenista local -->
                        <img style="width:45px;height:35px;" src="./assets/img/<?= $evento->getNacionalidadEquipoVisitante(); ?>"> <!-- Mostraremos la bandera del país del tenista visitante -->
                    <?php } ?>
                </td>
                <td><?= $evento->getNombreEquipoLocal(); ?> <br> <?= $evento->getNombreEquipoVisitante(); ?></td> <!-- Mostramos el nombre del equipo local y del equipo visitante -->
                <td>
                    <form action='./tablaEventos.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                        <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                        <input type="hidden" name="seleccionEvento" value=1> <!-- Guardaremos en el input 'seleccionEvento' el valor 1, porque se habrá pulsado el 1 -->
                        <input type="submit" value="<?= $evento->getCuotaEquipoLocal(); ?>"> <!-- Mostramos en el submit el valor de la cuota 1 por pantalla -->
                    </form> 
                </td>                  
                <td colspan="2">
                    <form action='./tablaEventos.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                        <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                        <input type="hidden" name="seleccionEvento" value=2> <!-- Guardaremos en el input 'seleccionEvento' el valor 2, porque se habrá pulsado el 2 -->
                        <input type="submit" value="<?= $evento->getCuotaEquipoVisitante(); ?>"> <!-- Mostramos en el submit el valor de la cuota 2 por pantalla -->
                    </form> 
                </td>
            </tr>
        <?php }} ?>
    </table>

    <!-- TABLA PARA EVENTOS DE TENIS -->
    <br><br>
    <table>
        <tr>
            <th colspan="3" class="titulo-tabla">Tenis</th>
            <th class="numero-tabla">1</th>
            <th class="numero-tabla">2</th>
        </tr>
        
        <?php
        foreach ($listaEventos as $evento ){ ?> <!-- Recorreremos todos los eventos disponibles, guardando cada uno en la variable $evento -->
            <?php if ($evento->getTipoEvento() == "Tenis") { ?>
            <tr>
                <td><?= $evento->getFechaEvento(); ?></td>  <!-- Mostramos la fecha del evento en la pantalla -->
                <td>
                    <?php if (($evento->getTipoEvento() == "Futbol") || ($evento->getTipoEvento() == "Basquet")){ ?>        <!-- Si el tipo de evento es Fútbol o Basquet -->
                        <img style="width:45px;height:45px;" src="./assets/img/<?= $evento->getLogoEquipoLocal(); ?>">  <!-- Mostraremos la imagen del logo del equipo local -->
                        <img style="width:45px;height:45px;" src="./assets/img/<?= $evento->getLogoEquipoVisitante(); ?>">  <!-- Mostraremos la imagen del logo del equipo visitante -->
                    <?php } else { ?>  <!-- En caso que no sea ni futbol ni basquet -->                                                     
                        <img style="width:45px;height:35px;" src="./assets/img/<?= $evento->getNacionalidadEquipoLocal(); ?>"> <!-- Mostraremos la bandera del país del tenista local -->
                        <img style="width:45px;height:35px;" src="./assets/img/<?= $evento->getNacionalidadEquipoVisitante(); ?>"> <!-- Mostraremos la bandera del país del tenista visitante -->
                    <?php } ?>
                </td>
                <td><?= $evento->getNombreEquipoLocal(); ?> <br> <?= $evento->getNombreEquipoVisitante(); ?></td> <!-- Mostramos el nombre del equipo local y del equipo visitante -->
                <td>
                    <form action='./tablaEventos.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                        <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                        <input type="hidden" name="seleccionEvento" value=1> <!-- Guardaremos en el input 'seleccionEvento' el valor 1, porque se habrá pulsado el 1 -->
                        <input type="submit" value="<?= $evento->getCuotaEquipoLocal(); ?>"> <!-- Mostramos en el submit el valor de la cuota 1 por pantalla -->
                    </form> 
                </td>                  
                <td colspan="2">
                    <form action='./tablaEventos.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                        <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                        <input type="hidden" name="seleccionEvento" value=2> <!-- Guardaremos en el input 'seleccionEvento' el valor 2, porque se habrá pulsado el 2 -->
                        <input type="submit" value="<?= $evento->getCuotaEquipoVisitante(); ?>"> <!-- Mostramos en el submit el valor de la cuota 2 por pantalla -->
                    </form> 
                </td>
            </tr>
        <?php }} ?>
    </table>
    <br><br>
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

