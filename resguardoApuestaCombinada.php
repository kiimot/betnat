<html>
    <head>
        <title>BETNAT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/css/style.css" type="text/css"/>
    </head>
    <body>
        <img class="logo" src="./assets/img/logoBetnat.png"/></a>
        <br><br><hr>

        <!-- Incluimos la cabecera -->
        <?php require_once './views/cabecera.php';
            
        // Iniciamos las SESSIONES
        session_start();

            // Si tenemos las variables cantidadApostadaCombinada y cuotaTotalCombinada (del fichero seleccionApuesta.php)
            if (isset($_GET['cantidadApostadaCombinada']) && isset($_GET['cuotaTotalCombinada'])){
                $cantidadApostadaCombinada = $_GET['cantidadApostadaCombinada']; // Guardamos la cantidadApostadaCombinada en la variable cantidadApostadaCombinada
                $cuotaTotalCombinada = $_GET['cuotaTotalCombinada'];    // Guardamos la cuotaTotalCombinada, en la variable cuotaTotalCombinada
                ?>
                <br><br>
                <table>
                    <tr>
                        <th>Fecha</th>
                        <th>Partido</th>
                        <th>Selección</th>
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
                        <td><?php echo $cuotaTotalCombinada ?></td> <!-- Mostramos la cuota total de la combinada -->
                        <td><?php echo $cantidadApostadaCombinada ?>€</td> <!-- Mostramos la cantidad apostada en la combinada -->
                        <td><?php echo $cantidadApostadaCombinada*$cuotaTotalCombinada ?>€</td> <!-- Mostramos las ganancias totales multiplicando la cantidad apostada por la cuota total -->
                            </tr>
            <?php } 
                $_SESSION['ultimaApuesta'] = "<h5>Last bet: Selection: COMBINADA Amount ".$cantidadApostadaCombinada."  Pot. Win. ".$cuotaTotalCombinada*$cantidadApostadaCombinada."</h5>" ;
            ?>

                    
                </table>
                <br><br>
                <form method='get' action="index.php"> <!-- Formulario para recoger el valor del input, nos llevará a index.php (nos servira para vaciar los arrays de las sessiones) -->
                    <input name="comeBack" class="realizarMasApuestas" type="submit" value="Realizar mas apuestas" /> <!-- Cuando pulsemos el input, el valor será Realizar mas apuesta -->
                </form>
        <!-- include footer -->
    </body>
    <footer>
        <div class="copyright">
            <div class="textoFooter">DAW2 M07</div>
        </div>
    </footer>
</html>