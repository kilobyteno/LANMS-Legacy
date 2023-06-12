<?php

return [

    'home' => array(
        'info' => 'Information',
        'where' => 'Var',
        'when' => 'När',
        'price' => 'Kostnad',
        'moreinfo' => 'Mer information',
    ),

    'members' => array(
        'search' => array(
            'title' => 'Sök medlemmar',
            'placeholder' => 'Användarnamn eller namn',
            'button' => 'Sök',
            'results' => 'resultat', //lowercase
        ),
        'newest' => array(
            'title' => 'Senaste medlemmarna',
        ),
        'lastonline' => array(
            'title' => 'Senast online',
        ),
        'table' => array(
            'username' => 'Användarnamn',
            'name' => 'Namn',
            'joined' => 'Gick med',
            'lastseen' => 'Senast sedd',
            'showing' => 'Visar :pluck av totalt :total medlemmar',
        ),
    ),

    'errors' => array(
        'button' => 'Tillbaka till startsidan',
        'default' => array(
            'title' => 'Okänt',
            'desc' => 'Något okänt har inträffat.',
        ),
        '401' => array(
            'title' => 'Obehörig',
            'desc' => 'Autentisering krävs och har misslyckats eller har ännu inte tillhandahållits.',
        ),
        '403' => array(
            'title' => 'Saknar behörighet!',
            'desc' => 'Du saknar behörighet för att komma åt denna sida.',
        ),
        '404' => array(
            'title' => 'Sidan kunde inte hittas',
            'desc' => 'Det verkar som att denna sida inte finns.',
        ),
        '419' => array(
            'title' => 'Sidan har gått ut',
            'desc' => 'Det verkar som att du har väntat för länge, uppdatera och försök igen!',
        ),
        '429' => array(
            'title' => 'För många förfrågningar',
            'desc' => 'Det verkar som att du har skickat för många förfrågningar inom en given tidsperiod.',
        ),
        '500' => array(
            'title' => 'Serverfel',
            'desc' => 'Det verkar som att vi har problem med servern. Prova gärna igen senare.',
        ),
        '503' => array(
            'title' => 'Underhållsläge',
            'desc' => 'Vi är snart tillbaka.',
        ),
    ),

    'tickets' => array(
        'free' => 'Gratis',
        'none' => 'Vi har ännu inga tillgängliga biljetter.',
    ),

];