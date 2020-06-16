<?php

return [

    'home' => array(
        'info' => 'Info',
        'where' => 'Hvor',
        'when' => 'Når',
        'price' => 'Pris',
        'moreinfo' => 'Mer info',
    ),

    'members' => array(
        'search' => array(
            'title' => 'Søk medlemmer',
            'placeholder' => 'Brukernavn eller navn',
            'button' => 'Søk',
            'results' => 'resultater', //lowercase
        ),
        'newest' => array(
            'title' => 'Nyeste medlemmer',
        ),
        'lastonline' => array(
            'title' => 'Siste påloggede medlemmer',
        ),
        'table' => array(
            'username' => 'Brukernavn',
            'name' => 'Navn',
            'joined' => 'Ble med',
            'lastseen' => 'Sist sett',
            'showing' => 'Viser :pluck av :total totalt antall medlemmer',
        ),
    ),

    'errors' => array(
        'button' => 'Tilbake til hjem',
        'default' => array(
            'title' => 'Ukjent',
            'desc' => 'Noe ukjent skjedde.',
        ),
        '401' => array(
            'title' => 'Uautorisert',
            'desc' => 'Godkjenning er påkrevd og har mislyktes eller er ennå ikke levert.',
        ),
        '403' => array(
            'title' => 'Forbudt',
            'desc' => 'Beklager, du er forbudt fra å få tilgang til denne siden.',
        ),
        '404' => array(
            'title' => 'Side ikke funnet',
            'desc' => 'Virker som om denne siden ikke eksisterer.',
        ),
        '429' => array(
            'title' => 'For mange forespørsler',
            'desc' => 'Det virker som om du har sendt for mange forespørsler på en gitt tid.',
        ),
        '500' => array(
            'title' => 'Server Feil',
            'desc' => 'Ser ut som om vi har noen serverproblemer.',
        ),
    ),

    'tickets' => array(
        'free' => 'Gratis',
    ),

];
