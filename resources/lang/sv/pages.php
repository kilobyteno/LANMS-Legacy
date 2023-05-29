<?php

return [

    'home' => array(
        'info' => 'Information',
        'where' => 'Vart',
        'when' => 'När',
        'price' => 'Kostnad',
        'moreinfo' => 'Mer information',
    ),

    'members' => array(
        'search' => array(
            'title' => 'Sök medlem',
            'placeholder' => 'Användarnamn eller namn',
            'button' => 'Sök',
            'results' => 'resultat', //lowercase
        ),
        'newest' => array(
            'title' => 'Nyaste medlemmen',
        ),
        'lastonline' => array(
            'title' => 'Senast online',
        ),
        'table' => array(
            'username' => 'Användarnamn',
            'name' => 'Namn',
            'joined' => 'Gick med',
            'lastseen' => 'Last Seen',
            'showing' => 'Visar :pluck av :total alla medlemmar',
        ),
    ),

    'errors' => array(
        'button' => 'Tillbaka hem',
        'default' => array(
            'title' => 'Nu har du kommit vilse..',
            'desc' => 'Denna sida existerar inte. Tror du att det är fel? Kontakta oss.',
        ),
        '401' => array(
            'title' => 'Obehörig',
            'desc' => 'Du har inte behörigheten att se denna sida.',
        ),
        '403' => array(
            'title' => 'Förbjuden',
            'desc' => 'Sorry, du har inte rätt behörighet att se denna sida.',
        ),
        '404' => array(
            'title' => 'Sidan hittades inte',
            'desc' => 'Det verkar som att denna sida inte finns.',
        ),
        '419' => array(
            'title' => 'Sidan har löpt ut',
            'desc' => 'Det verkar som att du väntat för länge, ladda om sidan.',
        ),
        '429' => array(
            'title' => 'För många förfrågningar',
            'desc' => 'Du har skickat för många förfrågningar på för kort tid. Försök igen senare.',
        ),
        '500' => array(
            'title' => 'Serverfel',
            'desc' => 'Det ser ut som att vi har problem med servern. Försök igen senare',
        ),
        '503' => array(
            'title' => 'Underhållsläge',
            'desc' => 'Vi är strax tillbaka.',
        ),
    ),

    'tickets' => array(
        'free' => 'Gratis',
        'none' => 'Vi har inte några biljetter tillgängliga ännu.',
    ),

];
