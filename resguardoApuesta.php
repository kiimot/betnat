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
            
            // Si tenemos las variables eventoAccion, seleccionCuota y la cantidad apostada (del fichero seleccionApuesta.php)
            if (isset($_GET['eventoAccion']) && isset($_GET['seleccionCuota']) && ($_GET['cantidadApostada'] >= 1)){
                $eventoAccion = $_GET['eventoAccion']; // Guardamos eventoAccion en la variable eventoAccion
                $seleccionCuota = $_GET['seleccionCuota']; // Guardamos seleccionCuota en la variable seleccionCuota
                $cantidadApostada = $_GET['cantidadApostada']; // Guardamos cantidadApostada en la variable cantidadApostada
                ?>
                <br><br>
                <table>
                    <tr>
                        <th>Fecha</th>
                        <th></th>
                        <th>Partido</th>
                        <th>Selección</th>
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
                            if ($seleccionCuota == 1){?><td><?= ($listaEventos[$eventoAccion]->getCuotaEquipoLocal()*$cantidadApostada); ?>€</td><?php } // Si la seleccion de la cuota es 1, multiplicamos la cuota local por la cantidad apostada y mostramos
                            elseif ($seleccionCuota == "X"){?><td><?= $listaEventos[$eventoAccion]->getCuotaEmpate()*$cantidadApostada; ?>€</td><?php } // Si la seleccion de la cuota es X, multiplicamos la cuota del empate por la cantidad apostada y mostramos
                            elseif ($seleccionCuota == 2){?><td><?= $listaEventos[$eventoAccion]->getCuotaEquipoVisitante()*$cantidadApostada; ?>€</td><?php } // Si la seleccion de la cuota es 2, multiplicamos la cuota visitante por la cantidad apostada y mostramos
                        ?>
                    </tr>
                </table>
                <br><br>

                <form method='get' action="index.php"> <!-- Formulario para recoger el valor del input, nos llevará a index.php (nos servira para vaciar los arrays de las sessiones) -->
                    <input name="comeBack" class="realizarMasApuestas" type="submit" value="Realizar mas apuestas" /> <!-- Cuando pulsemos el input, el valor será Realizar mas apuesta -->
                </form>


            <?php } ?>
        <!-- include footer -->
    </body>
    <footer>
        <div class="copyright">
            <div class="textoFooter">DAW2 M07</div>
        </div>
    </footer>
</html>