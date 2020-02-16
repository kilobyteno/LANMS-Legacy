<?php

return [

    'alert' => array(
        'noaddress' => 'Det ser ut til at du ikke har noen adresser knyttet til kontoen din. Du kan ikke reservere et sete før du har lagt til en primæradresse. Du må <a href=":url" class="alert-link">legge til</a> en.',
        'closed' => 'Sitteområdet er stengt for øyeblikket, du kan ikke reservere plasser eller endre reservasjoner.',
        'seatnotfound' => 'Fant ikke setet.',
        'seatingclosed' => 'Det er ikke mulig å reservere plasser på dette tidspunktet.',
        'paymentexist' => 'Dette setet har allerede en betaling tildelt den.',
        'youcantpay' => 'Du kan ikke betale for dette setet.',
        'noreservation' => 'Det var ingen reservasjon funnet for dette setet.',
        'carderror' => 'Vennligst sjekk kortinformasjonen din og prøv igjen',
        'pleasetryagain' => 'Vær så snill, prøv på nytt.',
        'seatpaid' => ':seatname er nå reservert og betalt for! Vi er glade for å ha deg med, velkommen!',
        'seattemppaid' => ':seatname er nå merket som at den skal betales ved inngangen! Vi er glade for å ha deg med, velkommen!',
        'paymentcantchange' => 'Du kan ikke endre betalingen av din reservasjon etter de første 48 timene.',
        'youcanchangepayment' => 'Du kan nå endre betalingen av din reservasjon.',
        'notpossibleonthisrow' => 'Det er ikke mulig å reservere plasser på denne raden.',
        'unpaidinvoice' => 'Du har en eller flere ubetalte fakturaer, betal disse først. Du vil kunne reservere plass når dette er tatt hånd om.',
        'tickets' => 'For mer informasjon om de forskjellige billetttypene, besøk <a href=":url">denne siden</a>.',
        'entrancepaymentnotallowed' => 'Denne billetten kan ikke betales ved inngangen akkurat nå. Betal med kort i stedet.',
    ),

    'closed' => 'Sitteområdet er ikke tilgjengelig for øyeblikket!',
    'checklater' => 'Vennligst kom tilbake senere...',

    'map' => array(
        'scene' => 'Scene',
        'exit' => 'Utgang',
        'kiosk' => 'Kiosk',
        'available' => 'Tilgjengelig',
        'unavailable' => 'Utilgjengelig',
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
        'view' => 'Vis sete',
        'pay' => 'Betal nå',
        'changepayment' => 'Endre betaling',
        'download' => 'Last ned PDF billett',
        'ticket' => 'Vis digital billett',
        'remove' => 'Fjern reservasjonen',
        'consentform' => array(
            'title' => 'Samtykkeskjema',
            'desc' => 'Personen som denne reservasjonen er reservert for er under 15 år og må ha med samtykkeskjema, ferdig utfyllt ved innskjekking på arrangementet.',
            'why' => 'Hvorfor ser jeg denne?',
        ),
        'pizza' => array(
            'title' => 'Pizza',
            'desc' => 'Du får en pizza på arrangementet!',
        ),
        'alert' => array(
            'notpossibleonthisrow' => 'Det er ikke mulig å reservere plasser på denne raden.',
            'alreadyreserved' => 'Stolen er allerede reservert.',
            'youcannotpay' => 'Du kan ikke betale for denne reservasjonen, personen som har reservert det må gjøre det.',
            'nobirthday' => 'Du må ha en fødselsdato tildelt kontoen din for å kunne reservere et sete.',
            'noaddresses' => 'Det ser ut til at du ikke har noen adresser knyttet til kontoen din. Du kan ikke reservere et sete før du har lagt til en primæradresse.',
            'limit' => 'Du har nådd reservasjonsgrensen. Så du har ikke lov til å reservere flere seter.',
            'limitself' => 'Du kan ikke reservere mer enn ett sete til deg selv. Vennligst velg et annet medlem du vil reservere dette setet for.',
            'nobirthdayfor' => 'Det ser ut som :name har ikke fødselsdato lagret på sin konto, de trenger det for å kunne reservere et sete.',
            'noaddressesfor' => 'Det ser ut som :name har ingen adresser lagret på til kontoen sin. De kan ikke reservere noe sete før de har lagt til en primæradresse.',
            'limitreservedfor' => ':name har ikke lov til å reservere flere seter.',
            'alreadyreservedfor' => ':name har allerede reservert plass.',
            'success' => 'Du har reservert dette setet!',
            'failure' => 'Noe gikk galt mens du lagret reservasjonen!',
            'ticketnoaccess' => 'Du har ikke lov til å se denne billetten.',
            'destroy' => array(
                'notfound' => 'Kunne ikke finne reservasjoner.',
                'noaccess' => 'Du kan ikke fjerne denne reservasjonen.',
                'cantberemovedafter' => 'Du kan ikke fjerne reservasjoner etter den første :hours timer.',
                'cantberemoved' => 'Du kan ikke fjerne denne reservasjonen etter at den er reservert.',
                'success' => 'Reservasjonen er nå fjernet!',
                'failure' => 'Noe gikk galt mens du slette reservasjonen.',
            ),
        ),
    ),

    'show' => array(
        'seat' => 'Sete',
        'reserved' => 'Dette setet er :type for dette medlemmet.',
        'reservedfor' => 'Reservert for',
        'agreement' => 'Jeg har lest og akseptert <strong>kjøpsbetingelser</strong> og <strong>regler</strong> for dette arrangementet.',
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
        'tickettype' => 'Billettype',
        'entrancebutton' => 'Betal ved inngangen*',
        'entrancedesc' => '* <strong>kjøpsbetingelser</strong> gjelder her også',
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

    'ticket' => array(
        'title' => 'Digital billett',
        'checkin' => array(
            'title' => 'Innsjekkingskoden din',
        ),
    ),

];
