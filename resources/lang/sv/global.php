<?php

return [

    'by' => 'av', // In 'Created by' etc.
    'yes' => 'Ja',
    'no' => 'Nej',
    'pleaseselect' => 'Välj',
    'choosefile' => 'Välj fil',
    'confirm' => 'Bekräfta',
    'new' => 'Ny',
    'default' => 'Standard',
    'current' => 'Nuvarande',
    'type' => 'Typ',
    'nodata' => 'Vi kan inte hitta det du söker...',
    'noaccess' => 'Du har inte åtkomst till denna sida!',
    'verification' => 'Verifikation',
    'verified' => 'Verifierad',
    'notverified' => 'Inte verifierad',
    'maintenance' => 'Vi uppdaterar hemsidan! Vi är snart tillbaka.',
    'unknown' => 'Unknown',
    'lastchanged' => 'Senast ändrad',

    'add' => 'Lägg till', // As in 'Add Address' etc.
    'edit' => 'Redigera', // As in 'edit Address' etc.
    'delete' => 'Radera', // As in 'Delete Address' etc.
    'savechanges' => 'Spara ändringar',
    'download' => 'Ladda ner',
    'send' => 'Skicka',
    'print' => 'Skriv ut',
    'activate' => 'Aktivera',
    'activated' => 'Aktiverad',
    'deactivate' => 'Avaktivera',
    'deactivated' => 'Avaktiverad',
    'verify' => 'Verifiera',
    '2fa' => 'Two-factor authentication (2FA)',

    'fullname' => 'Fullständigt namn',
    'firstname' => 'Förnamn',
    'lastname' => 'Efternamn',
    'username' => 'Användarnamn',
    'birthdate' => 'Födelsedatum',
    'phone' => 'Telefon',
    'gender' => array(
        'title' => 'Kön',
        'male' => 'Kille',
        'female' => 'Tjej',
        'transgender' => 'Trans',
        'genderless' => 'Vill inte svara',
    ),

    'clothingsize' => array(
        'title' => 'Önskad klädstorlek',
        'nochoice' => 'Vill inte säga',
        'xs' => 'XS',
        's' => 'S',
        'm' => 'M',
        'l' => 'L',
        'xl' => 'XL',
        'xxl' => 'XXL',
        '3xl' => '3XL',
    ),

    'staff' => 'Crew',
    'member' => 'Medlem',

    'lastseen' => 'Senast inloggad',
    'joined' => 'Gick med',
    'age' => 'Ålder',
    'yearsold' => 'år gammal', //lowercase
    'location' => 'Plats',
    'occupation' => 'Yrke',
    'about' => 'Om',
    'email' => 'E-post',
    'password' => 'Lösenord',
    
    'view' => 'Se',
    'status' => 'Status',
    'date' => 'Datum',
    'year' => 'År',
    'seat' => 'Plats',
    'reservedfor' => 'Reserverad till',
    'reservedby' => 'Reserved av',
    'details' => 'Detaljer',
    'reserved' => 'Reserverad',
    'temporary_reserved' => 'tillfälligt reserverad',

    'payment' => array(
        'amount' => 'belopp',
        'currency' => 'Valuta',
        'paid' => 'Betald',
        'refunded' => 'Återbetald',
        'cardbrand' => 'Märke',
        'cardtype' => array(
            'title' => 'Typ',
            'credit' => 'Credit',
            'debit' => 'Debit',
        ),
        'cardname' => 'Namn på kortet',
        'cardnumber' => 'Kortnummer',
        'cardexp' => 'Kortets utgångsdatum',
        'never' => 'aldrig',
        'failure' => 'Misslyckades',
        'succeeded' => 'Lyckades!',
        'message' => 'Meddelande',
        'duedate' => 'Förfallodatum',
    ),

    'time' => array(
        'created' => 'Skapad',
        'updated' => 'Uppdaterad',
        'at' => 'på',
        'expired' => 'Utgånget',
        'never' => 'aldrig',
    ),

    'address' => array(
        'street' => 'Gatuadress',
        'postalcode' => 'Postnummer',
        'city' => 'Stad',
        'county' => 'Län',
        'country' => 'Land',
    ),

    'alert' => array(
        'validation' => 'Validerings varning',
        'important' => 'Viktigt',
    ),

    'facebookmessenger' => array(
        'logged_in_greeting' => 'Hej! Vi är här för att hjälpa dig! :)',
        'logged_out_greeting' => 'Hej! Vi är här för att hjälpa dig! :)',
    ),

    'cookieconsent' => array(
        'message' => 'Denna webbplats använder cookies för att försäkra oss om att du får den bästa användarupplevelsen.',
        'dismiss' => 'Det är OK!',
        'link' => 'Vill du veta mer?',
    ),

    'notification' => array(
        'title' => 'Aviseringar',
        'time' => 'Tid',
        'message' => 'Meddelande',
        'nothing' => 'Inga nya aviseringar.',
        'viewall' => 'Se alla aviseringar',
        'dismissall' => 'Avfärda alla aviseringar',
        'dismiss' => 'Avfärda',
        'invoiceunpaid' => 'Du har en obetald faktura på :amount som förfaller :date!',
        'seatreservationexpires' => 'Din reservering för plats :seatname försvinner om inom 24 timmar om du inte fullföljer bokningen.',
        'seatreservationexpired' => 'Din plats på :seatname har försvunnit, detta eftersom du inte fullföljde bokningen inom 24 timmar.',
        'compoteamremoved' => ':user tog bort dig från turneringsteamet ":team".',
        'compoteamadded' => ':user lade till dig på turneringsteamet ":team".',
    ),
    
];
