<html>
    <head>
        <title>BETNAT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/css/style.css" type="text/css"/>
    </head>
    <body>
        <!-- include cabecera -->
        <?php require_once './views/cabecera.php'; ?>
        <!-- codigo web principal -->
        <!-- recepcion de datos -->
        <?php
        session_start();
        //Creamos la variable de sesion si no existe
        $i = 0;
        if (!isset($_SESSION['eventos']) && !isset($_SESSION['seleccionEventos'])){
            $_SESSION['eventos'] = [] ;
            $_SESSION['seleccionEventos'] = [] ; 
        }
        else{
            // Miramos si nos ha llegado una pizza seleccionada por parametro
            if (isset($_POST['evento']) && isset($_POST['seleccionEvento'])){
                $eventoSeleccionado = $listaEventos[$_POST['evento']];
                $seleccionEvento = $_POST['seleccionEvento'];
                //Añadimos la pizza a la variable sesion
                $_SESSION['eventos'][]= $eventoSeleccionado;
                $i = count($_SESSION['seleccionEventos']);
                $_SESSION['seleccionEventos'][$i]= $seleccionEvento;
            }
        }

        ?>

        <br><br>
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
            foreach ($listaEventos as $evento ){ ?>
                <tr>
                    <td><?= $evento->getCodigoEvento(); ?></td>
                    <td><?= $evento->getTipoEvento(); ?></td>
                    <td><?= $evento->getFechaEvento(); ?></td>
                    <td>
                        <?php if (($evento->getTipoEvento() == "Futbol") || ($evento->getTipoEvento() == "Basquet")){ ?>
                            <img style="width:35px;height:35px;" src="./assets/img/<?= $evento->getLogoEquipoLocal(); ?>"><br>
                            <img style="width:35px;height:35px;" src="./assets/img/<?= $evento->getLogoEquipoVisitante(); ?>">
                        <?php } else { ?>
                            <img style="width:35px;height:25px;" src="./assets/img/<?= $evento->getNacionalidadEquipoLocal(); ?>"><br><br>
                            <img style="width:35px;height:25px;" src="./assets/img/<?= $evento->getNacionalidadEquipoVisitante(); ?>">
                        <?php } ?>
                    </td>
                    <td><?= $evento->getNombreEquipoLocal(); ?> <br> <?= $evento->getNombreEquipoVisitante(); ?></td>
                    <td>
                        <form action='./index.php' method='post'>
                            <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> >
                            <input type="hidden" name="seleccionEvento" value=1>
                            <input type="submit" value="<?= $evento->getCuotaEquipoLocal(); ?>">
                        </form> 
                    </td>
                    <td>
                        <?php if ($evento->getTipoEvento() == "Futbol"){?>
                        <form action='./index.php' method='post'>
                            <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> >
                            <input type="hidden" name="seleccionEvento" value="X">
                            <input type="submit" value="<?= $evento->getCuotaEmpate(); ?>">
                        </form> 
                        <?php } ?>
                    </td>                   
                    <td>
                        <form action='./index.php' method='post'>
                            <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> >
                            <input type="hidden" name="seleccionEvento" value=2>
                            <input type="submit" value="<?= $evento->getCuotaEquipoVisitante(); ?>">
                        </form> 
                    </td>
                </tr>
            <?php } ?>
        </table>



        <br><br>




        <h2>APUESTAS SELECCIONADAS</h2>
        <?php
        if (!empty($_SESSION['eventos']) && !empty($_SESSION['seleccionEventos'])){?>
            <?php  foreach ($_SESSION['seleccionEventos'] as $seleccionEvento ){
                    echo "$seleccionEvento";
                }
                $contador = -1;
            ?>
            
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
            foreach ($_SESSION['eventos'] as $evento ){ ?>
                <tr>
                    <td><?= $evento->getFechaEvento(); ?></td>
                    <td>
                        <?php if (($evento->getTipoEvento() == "Futbol") || ($evento->getTipoEvento() == "Basquet")){ ?>
                            <img style="width:35px;height:35px;" src="./assets/img/<?= $evento->getLogoEquipoLocal(); ?>"><br>
                            <img style="width:35px;height:35px;" src="./assets/img/<?= $evento->getLogoEquipoVisitante(); ?>">
                        <?php } else { ?>
                            <img style="width:35px;height:25px;" src="./assets/img/<?= $evento->getNacionalidadEquipoLocal(); ?>"><br><br>
                            <img style="width:35px;height:25px;" src="./assets/img/<?= $evento->getNacionalidadEquipoVisitante(); ?>">
                        <?php } ?>
                    </td>
                    <td><?= $evento->getNombreEquipoLocal(); ?> <br> <?= $evento->getNombreEquipoVisitante(); ?></td>
                    <?php $contador++; ?>
                    <?php
                        if ($_SESSION['seleccionEventos'][$contador] == 1){?><td><?= $evento->getNombreEquipoLocal(); ?></td><?php }
                        elseif ($_SESSION['seleccionEventos'][$contador] == "X"){?><td>Empate</td><?php }
                        elseif ($_SESSION['seleccionEventos'][$contador] == 2){?><td><?= $evento->getNombreEquipoVisitante(); ?></td><?php }
                    ?>
                    <?php
                        if ($_SESSION['seleccionEventos'][$contador] == 1){?><td><?= $evento->getCuotaEquipoLocal(); ?></td><?php }
                        elseif ($_SESSION['seleccionEventos'][$contador] == "X"){?><td><?= $evento->getCuotaEmpate(); ?></td><?php }
                        elseif ($_SESSION['seleccionEventos'][$contador] == 2){?><td><?= $evento->getCuotaEquipoVisitante(); ?></td><?php }
                    ?>
                    <td>
                        <input type="number" name="cantidad">
                        <form action='./index.php' method='post'>
                            <input type="hidden" name="evento" value=<?= $evento->getCodigoEvento();?> >
                            <input class="bet" type="submit" value="BET">
                            <input class="del" type="submit" value="DEL">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php } ?>
        <!-- include footer -->
    </body>
</html>

