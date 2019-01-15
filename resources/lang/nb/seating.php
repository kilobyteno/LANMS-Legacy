<?php

return [

    'alert' => array(
        'noaddress' => 'Det ser ut til at du ikke har noen adresser knyttet til kontoen din. Du kan ikke reservere et sete før du har lagt til en primæradresse. Du burde <a href=":url" class="alert-link">legge til</a> en.',
        'closed' => 'Sitteområdet er stengt for øyeblikket, du kan ikke reservere plasser eller endre reservasjoner.',
    ),

    'closed' => 'Sitteområdet er ikke tilgjengelig for øyeblikket!',
    'checklater' => 'Vennligst kom tilbake senere...',

    'map' => array(
        'scene' => 'Scene',
        'exit' => 'Utgang',
        'kiosk' => 'Kiosk',
        'available' => 'Tilgjengelig',
        'you' => 'Dette setet er reservert til deg!',
        'reservedfor' => 'Reservert for',
        'tempreserved' => 'Midlertidig reservert av',
    ),

    'reservation' => array(
        'none' => 'Du har ikke reservert noen seter...',
        'your' => 'Dine reservasjoner',
        'foryou' => 'Seter reservert for deg',
        'expires' => 'Utløper',
        'paid' => 'Betalt',
        'notpaidyet' => 'Ikke betalt ennå',
        'notpaidyetdesc' => 'Betal ved inngangen',
        'notpaid' => 'Ubetalt',
        'view' => 'Vis',
        'pay' => 'Betal nå',
        'changepayment' => 'Endre betaling',
        'ticket' => 'Last ned billett',
        'remove' => 'Fjern reservasjonen',
        'consentform' => array(
            'title' => 'Samtykkeskjema',
            'desc' => 'Personen som denne reservasjonen er reservert for er under 16 år og må ha med samtykkeskjema, ferdig utfyllt ved innskjekking på arrangementet.',
            'why' => 'Hvorfor ser jeg denne?',
        ),
        'pizza' => array(
            'title' => 'Pizza',
            'desc' => 'Du får en pizza på arrangementet!',
        ),
    ),

    'show' => array(
        'seat' => 'Sete',
        'reserved' => 'Dette setet er :type for dette medlemmet.',
        'reservedfor' => 'Reservert for',
        'agreement' => 'Jeg har lest og godkjent <strong>vilkårene for bruk</strong> og <strong> regler</strong> for dette arrangementet.',
        'button' => 'Reserver sete',
        'alert' => array(
            'cannotbereserved' => 'Dette setet kan ikke reserveres!',
            'reservationlimit' => 'Du har ikke lov til å reservere mer enn <em>fem</em> seter.',
            'closed' => 'Sitteområdet er stengt for øyeblikket, du kan ikke reservere plasser eller endre reservasjoner.',
        ),
    ),

    'pay' => array(
        'title' => 'Betal for reservasjon',
        'price' => 'Pris',
        'entrancebutton' => 'Betal ved inngangen*',
        'entrancedesc' => '* Tilleggsavgift (:price) og <a href=":url">Vilkår</a> gjelder',
        'or' => 'eller',
        'button' => 'Betal nå',
        'processing' => 'Behandler betalingen',
        'card' => array(
            'number' => 'KORTNUMMER',
            'expmonth' => 'UTLØPSMÅNED',
            'expyear' => 'UTLØPSÅR',
            'cvc' => 'CVC',
            'name' => 'NAVN PÅ KORT',
        ),
    ),

];
