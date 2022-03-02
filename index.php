<html>
    <head>
        <title>HotPizza</title>
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
            if (isset($_POST['evento'])){
                echo 'Has seleccionado '. $_POST['evento'];
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
                            <?= $evento->getLogoEquipoLocal(); ?> <br> <?= $evento->getLogoEquipoVisitante(); ?>
                        <?php } else { ?>
                            <?= $evento->getNacionalidadEquipoLocal(); ?> <br> <?= $evento->getNacionalidadEquipoVisitante(); ?>
                        <?php } ?>
                    </td>
                    <td><?= $evento->getNombreEquipoLocal(); ?> <br> <?= $evento->getNombreEquipoVisitante(); ?></td>
                    <td>
                        <form action='./index.php' method='post'>
                            <input type="hidden" name="evento" value=<?= $evento->getCuotaEquipoLocal();?> >
                            <input type="submit" value="<?= $evento->getCuotaEquipoLocal(); ?>">
                        </form> 
                    </td>
                    <td>
                        <?php if ($evento->getTipoEvento() == "Futbol"){?>
                        <form action='./index.php' method='post'>
                            <input type="hidden" name="evento" value=<?= $evento->getCuotaEmpate();?> >
                            <input type="submit" value="<?= $evento->getCuotaEmpate(); ?>">
                        </form> 
                        <?php } ?>
                    </td>                   
                    <td>
                        <form action='./index.php' method='post'>
                            <input type="hidden" name="evento" value=<?= $evento->getCuotaEquipoVisitante();?> >
                            <input type="submit" value="<?= $evento->getCuotaEquipoVisitante(); ?>">
                        </form> 
                    </td>
                </tr>
            <?php } ?>
        </table>
        <!-- include footer -->
    </body>
</html>

