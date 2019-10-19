<?php

return [

    'global' => array(
        'hello' => 'Hei!',
        'whoops' => 'Ojsann!',
        'regards' => 'Med vennlig hilsen',
        'trouble' => 'Hvis du har problemer med å klikke på ":actionText" knappen, kopier og lim inn URLen nedenfor i nettleseren din: [:actionURL](:actionURL)',
        'youreceived' => 'Du har mottatt denne e-posten fordi du er registrert på:',
        'copyright' => 'Alle rettigheter reservert.',
    ),

    'reservation' => array(
        'expired' => array(
            'title' => 'Reservasjonen er fjernet!',
            'desc' => 'Din reservasjon for :seatname setet er fjernet, siden du ikke har betalt for det innen 48 timer fra reservasjonstiden.'
        ),
        'expires' => array(
            'title' => 'Din reservasjon vil bli fjernet snart!',
            'desc' => 'Din reservasjon for :seatname setet vil bli fjernet om 24 timer, hvis du ikke betaler for reservasjonen.',
        ),
    ),
    
];
