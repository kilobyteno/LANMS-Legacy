<?php

return [

    'by' => 'av', // In 'Created by' etc.
    'yes' => 'Ja',
    'no' => 'Nei',
    'pleaseselect' => 'Vennligst velg',
    'choosefile' => 'Velg fil',
    'confirm' => 'Bekreft',
    'new' => 'Nytt',
    'default' => 'Standard',
    'current' => 'Nåværende',
    'nodata' => 'Vi kan ikke finne noen data til deg...',
    'noaccess' => 'Du har ikke tilgang til denne siden!',

    'add' => 'Legg til', // As in 'Add Address' etc.
    'edit' => 'Rediger', // As in 'edit Address' etc.
    'delete' => 'Slett', // As in 'Delete Address' etc.
    'savechanges' => 'Lagre endringer',
    'download' => 'Last ned',

    'fullname' => 'Fullt navn',
    'firstname' => 'Fornavn',
    'lastname' => 'Etternavn',
    'username' => 'Brukernavn',
    'birthdate' => 'Bursdag',
    'phone' => 'Telefonnummer',
    'gender' => array(
        'title' => 'Kjønn',
        'male' => 'Mann',
        'female' => 'Kvinne',
        'transgender' => 'Transseksuell',
        'genderless' => 'Kjønnsløs',
    ),

    'staff' => 'Staff',
    'members' => 'Medlem',

    'lastseen' => 'Sist sett',
    'joined' => 'Ble med',
    'age' => 'Alder',
    'yearsold' => 'år gammel', //lowercase
    'location' => 'Lokasjon',
    'occupation' => 'Yrke',
    'about' => 'Om',
    'email' => 'E-post',
    'password' => 'Passord',
    
    'view' => 'Vis',
    'status' => 'Status',
    'date' => 'Dato',
    'year' => 'År',
    'seat' => 'Sete',
    'reservedfor' => 'Reservert for',
    'reservedby' => 'Reservert av',
    'details' => 'Detaljer',
    'reserved' => 'reservert',
    'temporary_reserved' => 'midlertidig reservert',

    'payment' => array(
        'amount' => 'Beløp',
        'currency' => 'Valuta',
        'paid' => 'Betalt',
        'refunded' => 'Refundert',
        'cardbrand' => 'Merke',
        'cardtype' => array(
            'title' => 'Type',
            'credit' => 'Kreditt',
            'debit' => 'Debet',
        ),
        'cardname' => 'Navn på kort',
        'cardnumber' => 'Kortnummer',
        'cardexp' => 'Kortutløpsdato',
        'never' => 'aldri',
        'failure' => 'Feilet',
        'succeeded' => 'Lyktes',
        'message' => 'Melding',
        'duedate' => 'Forfallsdato',
    ),

    'time' => array(
        'created' => 'Opprettet',
        'updated' => 'Oppdatert',
        'at' => 'kl',
        'expired' => 'utløpt',
        'never' => 'aldri',
    ),

    'address' => array(
        'address1' => 'Adresse',
        'address2' => 'Adresse 2',
        'postalcode' => 'Postnummer',
        'city' => 'By',
        'county' => 'Fylke',
        'country' => 'Land',
    ),

    'alert' => array(
        'validation' => 'Valideringsvarsel',
        'important' => 'Viktig',
    ),

    'facebookmessenger' => array(
        'logged_in_greeting' => 'Hei, vi er her for å hjelpe deg! :)',
        'logged_out_greeting' => 'Hei, vi er her for å hjelpe deg! :)',
    ),

    'cookieconsent' => array(
        'message' => 'Dette nettstedet bruker informasjonskapsler for å sikre at du får den beste opplevelsen på nettstedet vårt. Accepterer du dette?',
        'dismiss' => 'JEG AKSEPTERER',
        'link' => 'Lær mer',
    ),

    'notification' => array(
        'title' => 'Varsler',
        'time' => 'Tidspunkt',
        'message' => 'Melding',
        'nothing' => 'Ingen nye varsler.',
        'viewall' => 'Vis alle varsler',
        'dismissall' => 'Avvis alle varslene',
        'dismiss' => 'Avvis',
        'invoiceunpaid' => 'Du har en ubetalt faktura på :amount som forfaller på :date!',
        'seatreservationexpires' => 'Din reservasjon for :seatname setet vil bli fjernet om 24 timer, hvis du ikke betaler for reservasjonen.',
        'seatreservationexpired' => 'Din reservasjon for :seatname setet er fjernet, siden du ikke har betalt for det innen den midlertidige reservasjonstiden.',
    ),
    
];
