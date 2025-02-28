<?php

include "Aham.php";

$api = new Aham\Api('Nstmp8Brvnuxv9S9sb4PNww49cEYPIWKKlNIGqG_B44vBGlaAhUCVjwPGvDKV7h72D1sRN9waoXhhdYQ7wIVNQ');

$picture = new Aham\Picture("test");

$api->create(
    'Titlu',
    'Message',
    array(
        $picture,
        $picture,
        $picture
    )
);