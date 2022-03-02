<?php

#Crearemos eventos de fútbol, básquet y tenis
include './modelo/eventoDeportivo.php';

$liverpoolVSmadrid = new Futbol("F01","Futbol","26/06/2022 21:00","Liverpool","Real Madrid","imagen","imagen",1.60,2.30,3.10);
$chelseaVSbarcelona = new Futbol("F02","Futbol","27/06/2022 21:00","Chelsea","FC Barcelona","imagen","imagen",2.60,3.30,2.10);

$lakersVSceltics = new Basquet("B01","Basquet","13/04/2022 04:00","Los Angeles Lakers","Boston Celtics","imagen","imagen",2.50,1.35);
$warriorsVSclippers = new Basquet("B02","Basquet","16/04/2022 01:00","Golden State Warriors","Los Angeles Clippers","imagen","imagen",1.70,1.95);

$medevedevVSnadal = new Tenis("T01","Tenis","02/05/2022 05:10","Daniil Medevev","Rafael Nadal","imagen","imagen",1.66,2.20);
$djokovicVSalcaraz = new Tenis("T02","Tenis","30/04/2022 07:00","Novak Djokovic","Carlos Alcaraz","imagen","imagen",1.20,3.80);


$listaEventos = array($liverpoolVSmadrid,$chelseaVSbarcelona,$lakersVSceltics,$warriorsVSclippers,$medevedevVSnadal,$djokovicVSalcaraz);

?>