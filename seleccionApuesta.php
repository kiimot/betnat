<html>
    <head>
        <title>BETNAT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/css/style.css" type="text/css"/>
    </head>
    <body>
        <img class="logo" src="./assets/img/logoBetnat.png"/></a>
        <a href="index.php"><button class="cantidadSelecciones">AÑADIR MÁS EVENTOS</button></a>
        <br><br><hr><br><br>

        <!-- Incluimos la cabecera -->
        <?php require_once './views/cabecera.php';

        // Iniciamos las SESSIONES
        session_start();
        
        // Cógido web de la página donde accederemos a ver las apuestas seleccionadas
        
                    
        // COMPROBAMOS SI LAS SESSIONES ESTAN VACÍAS, si estan vacías no mostraremos la tabla, si estan llenas las dos si.
        if (!empty($_SESSION['eventos']) && !empty($_SESSION['seleccionEventos'])){?> 
                <table>
                <tr>
                    <th>Fecha</th>
                    <th></th>
                    <th>Partido</th>
                    <th>Selección</th>
                    <th>Cuota</th>
                    <th>Cantidad</th>
                </tr>
                <?php
                foreach ($_SESSION['eventos'] as $codigo=>$evento ){ ?>  <!-- Recorreremos todos los eventos disponibles, guardando cada uno en la variable $evento -->
                    <tr>
                        <td><?= $evento->getFechaEvento(); ?></td>   <!-- Mostramos la fecha del evento en la pantalla -->
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
                        <?php
                            if ($_SESSION['seleccionEventos'][$codigo] == 1){?><td><?= $evento->getNombreEquipoLocal(); ?></td><?php } // Si existe existe algun valor con la misma clave que la de la session de eventos seleccionados y el valor es 1, sacamos el nombre del equipo local
                            elseif ($_SESSION['seleccionEventos'][$codigo] == "X"){?><td>Empate</td><?php }  // Si existe existe algun valor con la misma clave que la de la session de eventos seleccionados y el valor es X, sacamos el por pantalla "Empate"
                            elseif ($_SESSION['seleccionEventos'][$codigo] == 2){?><td><?= $evento->getNombreEquipoVisitante(); ?></td><?php }  // Si existe existe algun valor con la misma clave que la de la session de eventos seleccionados y el valor es 2, sacamos el nombre del equipo visitante
                        ?>
                        <?php
                            if ($_SESSION['seleccionEventos'][$codigo] == 1){?><td><?= $evento->getCuotaEquipoLocal(); ?></td><?php } // Si existe existe algun valor con la misma clave que la de la session de eventos seleccionados y el valor es 1, sacamos la cuota del equipo local
                            elseif ($_SESSION['seleccionEventos'][$codigo] == "X"){?><td><?= $evento->getCuotaEmpate(); ?></td><?php }   // Si existe existe algun valor con la misma clave que la de la session de eventos seleccionados y el valor es X, sacamos la cuota del empate 
                            elseif ($_SESSION['seleccionEventos'][$codigo] == 2){?><td><?= $evento->getCuotaEquipoVisitante(); ?></td><?php }  // Si existe existe algun valor con la misma clave que la de la session de eventos seleccionados y el valor es 2, sacamos la cuota del equipo visitante
                        ?>
                        <td>
                            <form action='resguardoApuesta.php' method='get'> <!-- Mandaremos al fichero resguardoApuesta.php los datos recodigos de este formulario -->
                                <input type="number" name="cantidadApostada" required> <!-- Recogemos y enviamos la cantidad que va a apostar el usuario en la apuesta que pulsa bet -->
                                <input type="hidden" name="eventoAccion" value=<?= $evento->getCodigoEvento();?>> <!-- Recogemos y enviamos el código del evento del evento que quiere apostar -->
                                <input type="hidden" name="seleccionCuota" value=<?= $_SESSION['seleccionEventos'][$codigo];?>> <!-- Recogemos la opción seleccionada del evento '(1-X-2)' que quiere apostar -->
                                <input class="bet" type="submit" name="BET" value="BET"> <!-- Hacemos un input que servirá para apostar -->
                            </form>
                            <form action='./seleccionApuesta.php' method='post'> <!-- Haremos como un refresh cuando se pulse el input de submit y recogeremos estos valores -->
                                <input type="hidden" name="eventoAccion" value=<?= $evento->getCodigoEvento();?>> <!-- Recogemos el código del evento del evento que quiere eliminar -->
                                <input type="hidden" name="seleccionCuota" value=<?= $_SESSION['seleccionEventos'][$codigo];?>> <!-- Recogemos la opción seleccionada del evento '(1-X-2)' que quiere eliminar -->
                                <input class="del" type="submit" name="DEL" value="DEL"> <!-- Hacemos un input que servirá para eliminar -->
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>    
                        <td>COMBINADA BETNAT</td>
                        <td><?php
                            $cuotaTotalFutbol = 0;  // Aquí guardaremos la cuota total de todos los eventos de futbol
                            $cuotaTotalBasquet = 0;  // Aquí guardaremos la cuota total de todos los eventos de basquet
                            $cuotaTotalTenis = 0;  // Aquí guardaremos la cuota total de todos los eventos de tenis

                            foreach ($_SESSION['eventos'] as $codigo=>$evento ){ ?> <!-- Recorreremos todos los eventos disponibles, guardando cada uno en la variable $evento -->
                                <?php if ($evento->getTipoEvento() == "Futbol"){ // Si el tipo de evento es futbol                             
                                    if ($_SESSION['seleccionEventos'][$codigo] == 1){ $cuota = $evento->getCuotaEquipoLocal();  $cuotaTotalFutbol += $cuota; } // Comprobamos la sesion con la clave, y si se ha recogido un 1, guardamos la cuota local y la añadimos a la cuotaTotal de futbol
                                    elseif ($_SESSION['seleccionEventos'][$codigo] == "X"){ $cuota = $evento->getCuotaEmpate(); $cuotaTotalFutbol += $cuota; } // Comprobamos la sesion con la clave, y si se ha recogido una X, guardamos la cuota del empate y la añadimos a la cuotaTotal de futbol
                                    elseif ($_SESSION['seleccionEventos'][$codigo] == 2){ $cuota = $evento->getCuotaEquipoVisitante();  $cuotaTotalFutbol += $cuota; } // Comprobamos la sesion con la clave, y si se ha recogido un 2, guardamos la cuota visitante y la añadimos a la cuotaTotal de futbol
                                } elseif ($evento->getTipoEvento() == "Basquet"){ // Si el tipo de evento es basquet 
                                    if ($_SESSION['seleccionEventos'][$codigo] == 1){ $cuota = $evento->getCuotaEquipoLocal();  $cuotaTotalBasquet += $cuota; } // Comprobamos la sesion con la clave, y si se ha recogido un 1, guardamos la cuota local y la añadimos a la cuotaTotal de basquet
                                    elseif ($_SESSION['seleccionEventos'][$codigo] == 2){ $cuota = $evento->getCuotaEquipoVisitante();  $cuotaTotalBasquet += $cuota; } // Comprobamos la sesion con la clave, y si se ha recogido un 2, guardamos la cuota visitante y la añadimos a la cuotaTotal de basquet
                                } elseif ($evento->getTipoEvento() == "Tenis"){
                                    if ($_SESSION['seleccionEventos'][$codigo] == 1){ $cuota = $evento->getCuotaEquipoLocal(); $cuotaTotalTenis += $cuota; } // Comprobamos la sesion con la clave, y si se ha recogido un 1, guardamos la cuota local y la añadimos a la cuotaTotal de tenis
                                    elseif ($_SESSION['seleccionEventos'][$codigo] == 2){ $cuota = $evento->getCuotaEquipoVisitante();  $cuotaTotalTenis += $cuota; } // Comprobamos la sesion con la clave, y si se ha recogido un 2, guardamos la cuota visitante y la añadimos a la cuotaTotal de tenis
                                }
                            } ?>
                            <?php 
                                if ((count($_SESSION['eventos']) >= 2)){ // Si tenemos mas de 1 evento seleccionado, la forma de calcular la cuota combinada será diferente a si hay solo 1
                                    $suplemento = ($cuotaTotalFutbol + $cuotaTotalBasquet + $cuotaTotalTenis)/(count($_SESSION['eventos'])*10); // Calcularemos el suplemento de la cuota de la combinada
                                    $cuotaTotalCombinada = round($cuotaTotalFutbol + $cuotaTotalBasquet + $cuotaTotalTenis + $suplemento, 2); // Sumamos todo y redondeamos a dos decimales
                                    echo $cuotaTotalCombinada; // Mostramos la cuota todal combinada
                                }else { // Si hay solo 1 evento seleccionado, la cuota no cambiará ni tendrá un suplemento
                                    $cuotaTotalCombinada = round($cuotaTotalFutbol + $cuotaTotalBasquet + $cuotaTotalTenis, 2); // Sumamos todo y redondeamos a dos decimales
                                    echo $cuotaTotalCombinada; // Mostramos la cuota todal combinada
                                }
                            ?>
                        </td>  
                        <td>
                            <form action='resguardoApuestaCombinada.php' method='get'> <!-- Mandaremos al fichero resguardoApuesta.php los datos recodigos de este formulario -->
                                <input type="number" name="cantidadApostadaCombinada" required> <!-- Introducimos la cantidad que queremos apostar y la guardamos -->
                                <input type="hidden" name="cuotaTotalCombinada" value=<?= $cuotaTotalCombinada; ?>> <!-- También guardaremos el valor de la cuota total combinada -->
                                <input class="bet" type="submit" name="BETCOMBINADA" value="BET"> <!-- Si pulsamos en BET, apostaremos en la combinada de todas las selecciones -->
                            </form>
                        </td>                     
                    </tr>
            </table>
        <?php }  
        
        if (isset($_POST['DEL'])){  // Si existe la variable DEL
            if (isset($_POST['eventoAccion']) && isset($_POST['seleccionCuota'])){  // Y si existen las variables eventoAccion y seleccionCuota
                unset($_SESSION['eventos'][$_POST['eventoAccion']]); // Quitamos del array de eventos seleccionados, el evento que se ha pulsado el input DEL, lo buscaremos a traves del código de diccionario
                unset($_SESSION['seleccionEventos'][$_POST['eventoAccion']]);   // Tambien lo quitaremos del array de la seleccion de los eventos, con el código de diccionario.
                ?> <meta http-equiv="refresh" content="0" ><?php // Refrescamos la página (Para hacer que se vaya el evento que se ha eliminado)
            }
        }
        ?>
        
    </body>
    <footer>
        <div class="copyright">
            <div class="textoFooter">DAW2 M07</div>
        </div>
    </footer>
</html>