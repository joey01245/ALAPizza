<?php
    require_once('joeypdo_class.php');

    $db = new JoeyPDO('wamp'); // wamp kun je weglaten, is default

    $pizzadata = $db->getAllPizzas();
    JoeyPDO::pp($pizzadata, "Alle PIZZA's");
//
    $pizzadata = $db->getPizzaById(2, true);
    JoeyPDO::pp($pizzadata, "Een enkele PIZZA");


    /*
    In de class heb je een methode getPizzaAndCategory, die doet wat de naam
    aangeeft. De signatuur is:
        
        $getPizzaAndCategory($asTable=false, $border=false)
        
    Versie 1 heeft geen argumenten, dus NIET als tabel en GEEN border.
    Versie 2 geeft output als een tabel (override van asTable), ZONDER border.
    Versie 3 geet output als een tabel en MET border (override van $asTable en $border)
    */

//    $pizzaCat = $db->getPizzaAndCategory(); // versie 1
//    JoeyPDO::pp($pizzaCat, "zonder tabel of border:");
//
//    //output als tabel, zonder randen
//    //
//    $pizzaCat = $db->getPizzaAndCategory(true); // versie 2
//    JoeyPDO::pp($pizzaCat, "als tabel zonder border:");
////
////    // output als tabel, met randen
////    //
//    $pizzaCat = $db->getPizzaAndCategory(true, true); // versie 3
//    JoeyPDO::pp($pizzaCat, "als tabel met border:");

    //////////////////////////////////////////////////////////////

    // Door de static method pp kan het ook in één opdracht:

//    JoeyPDO::pp($db->getPizzaByNamepart('a'), "Zoeken op een deel van de naam:");
//    JoeyPDO::pp($db->getPizzaNameByNamepart('a'), "Zoeken op een deel van de naam:");
    echo $db->getPizzaNameByNamepart('a');
    echo $db->getRandomPizza();
//    echo $db->getPizzaByNamepart('a');

