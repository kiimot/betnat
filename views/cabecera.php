<?php

include './modelo/eventoDeportivo.php';

$liverpoolVSmadrid = new Futbol("F01","Futbol","26/06/2022 21:00","Liverpool","Real Madrid","liverpool.png","madrid.png",1.60,2.30,3.10);
$chelseaVSbarcelona = new Futbol("F02","Futbol","27/06/2022 21:00","Chelsea","FC Barcelona","chelsea.png","barcelona.png",2.60,3.30,2.10);

$lakersVSceltics = new Basquet("B01","Basquet","13/04/2022 04:00","Los Lakers","Celtics","lakers.png","celtics.png",2.50,1.35);
$warriorsVSclippers = new Basquet("B02","Basquet","16/04/2022 01:00","GS Warriors","Clippers","warriors.png","clippers.png",1.70,1.95);

$medevedevVSnadal = new Tenis("T01","Tenis","02/05/2022 05:10","Daniil Medevev","Rafael Nadal","rusia.png","españa.png",1.66,2.20);
$djokovicVSalcaraz = new Tenis("T02","Tenis","30/04/2022 07:00","Novak Djokovic","Alexander Zverev","serbia.png","alemania.png",1.20,3.80);

$listaEventos = array("F01" => $liverpoolVSmadrid, "F02" => $chelseaVSbarcelona, "B01" => $lakersVSceltics, "B02" => $warriorsVSclippers, "T01" => $medevedevVSnadal, "T02" => $djokovicVSalcaraz);

?>