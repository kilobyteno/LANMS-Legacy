<?php

return [

    'by' => 'av', // I 'Skapad av' etc.
    'yes' => 'Ja',
    'no' => 'Nej',
    'pleaseselect' => 'Välj',
    'choosefile' => 'Välj fil',
    'confirm' => 'Bekräfta',
    'new' => 'Ny',
    'default' => 'Standard',
    'current' => 'Nuvarande',
    'type' => 'Typ',
    'nodata' => 'Vi kan inte hitta någon data för dig...',
    'noaccess' => 'Du har inte åtkomst till denna sida!',
    'verification' => 'Verifiering',
    'verified' => 'verifierad',
    'notverified' => 'Ej verifierad',
    'maintenance' => 'Vi uppdaterar systemet. Vi är snart tillbaka.',
    'unknown' => 'Okänd',
    'lastchanged' => 'Senast ändrad',

    'add' => 'Lägg till', // Som i 'Lägg till adress' osv.
    'edit' => 'Redigera', // Som i 'Redigera adress' osv.
    'delete' => 'Ta bort', // Som i 'Ta bort adress' osv.
    'savechanges' => 'Spara ändringar',
    'download' => 'Ladda ner',
    'send' => 'Skicka',
    'print' => 'Skriv ut',
    'activate' => 'Aktivera',
    'activated' => 'Aktiverad',
    'deactivate' => 'Inaktivera',
    'deactivated' => 'Inaktiverad',
    'verify' => 'Verifiera',
    '2fa' => 'Tvåfaktorsautentisering (2FA)',

    'fullname' => 'Fullständigt namn',
    'firstname' => 'Förnamn',
    'lastname' => 'Efternamn',
    'username' => 'Användarnamn',
    'birthdate' => 'Födelsedatum',
    'phone' => 'Telefonnummer',
    'gender' => array(
        'title' => 'Kön',
        'male' => 'Man',
        'female' => 'Kvinna',
        'transgender' => 'Vill inte ange',
        'genderless' => 'Könsneutral',
    ),

    'clothingsize' => array(
        'title' => 'Föredragen klädstorlek',
        'nochoice' => 'Vill inte ange',
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

    'lastseen' => 'Senast sedd',
    'joined' => 'Gick med',
    'age' => 'Ålder',
    'yearsold' => 'år gammal',
    'location' => 'Plats',
    'occupation' => 'Yrke',
    'about' => 'Om',
    'email' => 'E-post',
    'password' => 'Lösenord',
    
    'view' => 'Visa',
    'status' => 'Status',
    'date' => 'Datum',
    'year' => 'År',
    'seat' => 'Plats',
    'reservedfor' => 'Reserverad för',
    'reservedby' => 'Reserverad av',
    'details' => 'Detaljer',
    'reserved' => 'reserverad',
    'temporary_reserved' => 'tillfälligt reserverad',

    'payment' => array(
        'amount' => 'Belopp',
        'currency' => 'Valuta',
        'paid' => 'Betald',
        'refunded' => 'Återbetald',
        'cardbrand' => 'Kort',
        'cardtype' => array(
            'title' => 'Typ',
            'credit' => 'Kredit',
            'debit' => 'Debet',
        ),
        'cardname' => 'Namn på kortet',
        'cardnumber' => 'Kortnummer',
        'cardexp' => 'Kortets utgångsdatum',
        'never' => 'aldrig',
        'failure' => 'Fel',
        'succeeded' => 'Lyckades',
        'message' => 'Meddelande',
        'duedate' => 'Förfallodatum',
    ),

    'time' => array(
        'created' => 'Skapad',
        'updated' => 'Uppdaterad',
        'at' => 'kl.',
        'expired' => 'utgått',
        'never' => 'aldrig',
    ),

    'address' => array(
        'street' => 'Gata',
        'postalcode' => 'Postnummer',
        'city' => 'Stad',
        'county' => 'Län',
        'country' => 'Land',
    ),

    'alert' => array(
        'validation' => 'Valideringsvarning',
        'important' => 'Viktigt',
    ),

    'facebookmessenger' => array(
        'logged_in_greeting' => 'Hej, vi är här för att hjälpa dig! :)',
        'logged_out_greeting' => 'Hej, vi är här för att hjälpa dig! :)',
    ),

    'cookieconsent' => array(
        'message' => 'Den här webbplatsen använder cookies för att säkerställa att du får den bästa upplevelsen på vår webbplats.',
        'dismiss' => 'OK, jag godkänner',
        'link' => 'Läs mer',
    ),

    'notification' => array(
        'title' => 'Notifieringar',
        'time' => 'Tid',
        'message' => 'Meddelande',
        'nothing' => 'Inga nya notifieringar.',
        'viewall' => 'Visa alla notifieringar',
        'dismissall' => 'Avvisa alla notifieringar',
        'dismiss' => 'Avvisa',
        'invoiceunpaid' => 'Du har en obetald faktura på :amount som förfaller den :date!',
        'seatreservationexpires' => 'Din reservation för platsen :seatname kommer att tas bort om 24 timmar om du inte slutför din bokning.',
        'seatreservationexpired' => 'Din reservation för platsen :seatname har tagits bort, eftersom du inte har slutfört bokningen inom den tillfälliga reservationsperioden.',
        'compoteamremoved' => ':user har tagit bort dig från ":team"',
        'compoteamadded' => ':user har lagt till dig i ":team"',
    ),
    
];
