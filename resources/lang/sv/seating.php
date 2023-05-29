<?php

return [

    'alert' => array(
        'noaddress' => 'Det verkar inte som att du angett någon adress på ditt konto. Du behöver <a href=":url" class="alert-link">lägga till</a> en.',
        'closed' => 'Platsbokningen är stängd just nu. Gå med i vår discord och håll utkik här på hemsidan för uppdateringar.',
        'seatnotfound' => 'Kunde inte hitta platsen.',
        'seatingclosed' => 'Bokningen är stängd och du kan därför inte boka plats just nu..',
        'paymentexist' => 'Denna plats är redan betald.',
        'youcantpay' => 'Du kan inte betala för den här platsen.',
        'noreservation' => 'Det finns ingen bokning för den här platsen.',
        'carderror' => 'Något verkar ha gått fel. Har du skrivit in rätt kortuppgifter?',
        'pleasetryagain' => 'Försök igen.',
        'seatpaid' => ':seatname är nu bokad och klar! Vi ser fram emot ditt deltagande, välkommen!',
        'seattemppaid' => ':seatname är nu makerad för att betalas i entrén! Vi ser fram emot ditt deltagande, välkommen!',
        'paymentcantchange' => 'Du kan inte justera din betalning efter 48 timmar. Kontakta oss vid problem..',
        'youcanchangepayment' => 'Du kan nu justera din betalning.',
        'notpossibleonthisrow' => 'Du kan inte reservera platser på den här raden.',
        'unpaidinvoice' => 'Du har en eller mer obetalda avgifter. Du kan boka din plats när dessa är betalda.',
        'tickets' => 'För mer information gällande olika biljetter, besök <a href=":url">denna sida</a>.',
        'entrancepaymentnotallowed' => 'Denna biljett kan inte betalas i entrén. Betala med kort istället.',
    ),

    'closed' => 'Platskartan är inte tillgänglig just nu.',
    'checklater' => 'Prova igen vid ett senare tillfälle..',

    'map' => array(
        'scene' => 'Scen',
        'exit' => 'Utgång',
        'kiosk' => 'Kiosk',
        'available' => 'Tillgänglig',
        'unavailable' => 'Upptagen',
        'you' => 'Denna plats är bokad av dig!',
        'reservedfor' => 'Bokad av',
        'tempreserved' => 'Temporärt bokad av',
    ),

    'reservation' => array(
        'none' => 'Du har inte bokad någon plats...',
        'your' => 'Dina bokningar',
        'foryou' => 'Plats bokad',
        'expires' => 'Utgår',
        'paid' => 'Betald',
        'notpaidyet' => 'Inte betald',
        'notpaidyetdesc' => 'Betala i entrén',
        'notpaid' => 'Obetald',
        'view' => 'Se plats',
        'pay' => 'Betala nu',
        'changepayment' => 'Ändra betalning',
        'download' => 'Ladda ner PDF biljett',
        'ticket' => 'Visa digital biljett',
        'remove' => 'Radera bokning',
        'consentform' => array(
            'title' => 'Samtyckesblankett',
            'desc' => 'Personen som bokningen gäller är under 10 år. Hen behöver därför kunna uppvisa en ifylld Samtyckesblankett.',
            'why' => 'varför ser jag detta?',
        ),
        'pizza' => array(
            'title' => 'Pizza',
            'desc' => 'Du får pizza på evenemanget!',
        ),
        'alert' => array(
            'notpossibleonthisrow' => 'Du kan inte reservera platser på denna rad.',
            'alreadyreserved' => 'Platsen har redan blivit bokad.',
            'youcannotpay' => 'Du kan inte betala för den här platsen. Personen som gjort bokningen behöver göra det.',
            'nobirthday' => 'Du behöver ha ett födelsedatum på ditt konto för att kunna boka en plats.',
            'noaddress' => 'Du verkar inte ha en adress registrerad på ditt konto.',
            'limit' => 'Du har nått gränsen för hur många platser du får boka. Du kan därför inte boka fler platser.',
            'limitself' => 'Du kan inte boka mer än en plats till dig själv. Du kan välja att boka denna plats till en annan person.',
            'nobirthdayfor' => 'Det verkar som att :name inte har ett födelsedatum registrerat, :name kommer att behöva det för att boka en plats.',
            'noaddressfor' => 'Det verkar som att :name inte har en adress registrerad. Registrera en adress för att kunna boka en plats.',
            'limitreservedfor' => ':name kan inte boka fler platser.',
            'alreadyreservedfor' => ':name har redan bokat en plats.',
            'success' => 'Du har nu bokad denna plats!',
            'failure' => 'Något gick fel när vi skulle spara din bokning!',
            'ticketnoaccess' => 'Du har inte tillåtelse att se denna biljett.',
            'destroy' => array(
                'notfound' => 'Kunde inte hitta bokningen.',
                'noaccess' => 'Du kan inte ta bort denna bokning.',
                'cantberemovedafter' => 'Du kan inte ta bort bokningen efter :hours timmar.',
                'cantberemoved' => 'Du kan inte ta bort den här bokningen efter den blivit reserverad.',
                'success' => 'Din bokning är borttagen!',
                'failure' => 'Något gick fel när vi skulle ta bort din bokning.',
            ),
        ),
    ),

    'show' => array(
        'seat' => 'Plats',
        'reserved' => 'Den här platsen är :type.',
        'reservedfor' => 'Bokad av',
        'agreement' => 'Jag har läst och godkänner <strong>Köpvillkoren</strong> och <strong>reglerna</strong> för detta evenemang.',
        'button' => 'Bokad plats',
        'alert' => array(
            'cannotbereserved' => 'Den här platsen kan inte bokas!',
            'reservationlimit' => 'Det är inte tillåtet att boka mer än <em>fem</em> platser.',
            'closed' => 'Platsbokningen är stängd för tillfället. Försök igen vid ett senare tillfälle.',
        ),
    ),

    'pay' => array(
        'title' => 'Betala för bokning',
        'price' => 'Pris',
        'tickettype' => 'Biljett',
        'entrancebutton' => 'Betala vid entrén*',
        'entrancedesc' => '* <strong>Köpvillkor</strong> gäller',
        'or' => 'eller',
        'button' => 'Betala nu',
        'processing' => 'Bearbetar betalning',
        'card' => array(
            'number' => 'KORT NUMMER',
            'expmonth' => 'EXP. MÅNAD',
            'expyear' => 'EXP. ÅR',
            'cvc' => 'CVC',
            'name' => 'NAMN PÅ KORT',
        ),
    ),

    'ticket' => array(
        'title' => 'Digital biljett',
        'checkin' => array(
            'title' => 'Din checkin kod',
        ),
    ),

    'checkin' => array(
        'title' => 'Self check-in',
        'subtitle' => 'Skriv din check-in kod här!',
        'info' => 'Du behöver verifiera ditt telefonnummer.',
        'alert' => array(
            'success' => 'Lyckades! Kontakta crew för att få ditt deltagarband.',
            'notfound' => 'Hittades inte.',
            'notallowed' => 'Du kan inte göra self check-in. Du är antingen för ung eller har inte verifierat ditt telefonnummer.',
            'failed' => 'Self check-in misslyckades.',
        ),
    ),

];
