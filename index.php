<html>
    <head>
        <title>BETNAT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/css/style.css" type="text/css"/>
    </head>
    <body>
        <div class="cabecera">
            <img class="logo" src="./assets/img/logoBetnat.png"/>
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
                    $_SESSION['eventos'][$_POST['evento']]= $eventoSeleccionado;        // Metemos el objeto eventoSeleccionado en la session 'eventos' con una clave de diccionario, que será el código del evento seleccionado (así, buscando por código encontraremos los eventos seleccionados)      
                    $_SESSION['seleccionEventos'][$_POST['evento']]= $seleccionEvento;  // Metemos la opcion del evento (1-X-2), en la sesion 'seleccionEventos' con la misma clave de diccionario que la session 'eventos', para que identifiquemos la opción de cada evento seleccionado
                }
            }

            // En resumen, vamos a tener dos arrays con las mismas claves de diccionario para almacenar el objeto evento y tambien que cuota hemos marcado.
            // Ejemplo: "F01" => Objeto EventoSeleccionado / "F01" => 1
            // Importante: NO se podrán seleccionar dos veces la misma apuesta ni diferentes opciones de la misma apuesta.

            ?>

            <!-- Boton donde nos dirá la cantidad de SELECCIONES que hemos marcado -->
            <a href="seleccionApuesta.php">
                <button class="cantidadSelecciones"> <?php if (isset($_SESSION['eventos'])){ echo count($_SESSION['eventos'])." SELECCIONES"; }  ?>  </button>
            </a>
        </div>
        
        <!-- Aquí empezaremos a montar la tabla con TODOS los eventos disponibles -->
        <br><hr><br><br>
        <table>
            <tr>
                <th>Código Evento</th>
                <th>Tipo Evento</th>
                <th>Fecha Evento</th>
                <th></th>
                <th>Partido</th>
                <th>1</th>
                <th>X</th>
                <th>2</th>
            </tr>

            <?php
            foreach ($listaEventos as $evento ){ ?> <!-- Recorreremos todos los eventos disponibles, guardando cada uno en la variable $evento -->
                <tr>
                    <td><?= $evento->getCodigoEvento(); ?></td> <!-- Mostramos el código del evento en la pantalla -->
                    <td><?= $evento->getTipoEvento(); ?></td>   <!-- Mostramos el tipo del evento en la pantalla -->
                    <td><?= $evento->getFechaEvento(); ?></td>  <!-- Mostramos la fecha del evento en la pantalla -->
                    <td>
                        <?php if (($evento->getTipoEvento() == "Futbol") || ($evento->getTipoEvento() == "Basquet")){ ?>        <!-- Si el tipo de evento es Fútbol o Basquet -->
                            <img style="width:35px;height:35px;" src="./assets/img/<?= $evento->getLogoEquipoLocal(); ?>"><br>  <!-- Mostraremos la imagen del logo del equipo local -->
                            <img style="width:35px;height:35px;" src="./assets/img/<?= $evento->getLogoEquipoVisitante(); ?>">  <!-- Mostraremos la imagen del logo del equipo visitante -->
                        <?php } else { ?>  <!-- En caso que no sea ni futbol ni basquet -->                                                     
                            <img style="width:35px;height:25px;" src="./assets/img/<?= $evento->getNacionalidadEquipoLocal(); ?>"><br><br> <!-- Mostraremos la bandera del país del tenista local -->
                            <img style="width:35px;height:25px;" src="./assets/img/<?= $evento->getNacionalidadEquipoVisitante(); ?>"> <!-- Mostraremos la bandera del país del tenista visitante -->
                        <?php } ?>
                    </td>
                    <td><?= $evento->getNombreEquipoLocal(); ?> <br> <?= $evento->getNombreEquipoVisitante(); ?></td> <!-- Mostramos el nombre del equipo local y del equipo visitante -->
                    <td>
                        <form action='./index.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                            <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                            <input type="hidden" name="seleccionEvento" value=1> <!-- Guardaremos en el input 'seleccionEvento' el valor 1, porque se habrá pulsado el 1 -->
                            <input type="submit" value="<?= $evento->getCuotaEquipoLocal(); ?>"> <!-- Mostramos en el submit el valor de la cuota 1 por pantalla -->
                        </form> 
                    </td>
                    <td>
                        <?php if ($evento->getTipoEvento() == "Futbol"){?>  <!-- Como la cuota empate solo la tiene el evento futbol, le meteremos el condicional -->
                            <form action='./index.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                                <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                                <input type="hidden" name="seleccionEvento" value="X"> <!-- Guardaremos en el input 'seleccionEvento' el valor X, porque se habrá pulsado el X -->
                                <input type="submit" value="<?= $evento->getCuotaEmpate(); ?>"> <!-- Mostramos en el submit el valor de la cuota X por pantalla -->
                            </form> 
                        <?php } ?>
                    </td>                   
                    <td>
                        <form action='./index.php' method='post'> <!-- Cuando pulsemos al SUBMIT, guardaremos los datos de los inputs -->
                            <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> > <!-- Guardamos en el input 'evento' el código del evento seleccionado -->
                            <input type="hidden" name="seleccionEvento" value=2> <!-- Guardaremos en el input 'seleccionEvento' el valor 2, porque se habrá pulsado el 2 -->
                            <input type="submit" value="<?= $evento->getCuotaEquipoVisitante(); ?>"> <!-- Mostramos en el submit el valor de la cuota 2 por pantalla -->
                        </form> 
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php
            if (isset($_SESSION['ultimaApuesta'])){
                echo $_SESSION['ultimaApuesta'];
            }
        ?>

    </body>
    <footer>
        <div class="copyright">
            <div class="textoFooter">DAW2 M07</div>
        </div>
    </footer>
</html>

