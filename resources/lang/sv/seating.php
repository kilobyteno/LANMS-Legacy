<?php

return [

    'alert' => array(
        'noaddress' => 'Det verkar som att du inte har en adress kopplad till ditt konto. Du kommer inte kunna reservera någon plats innan du har lagt till en adress. Du bör <a href=":url" class="alert-link">lägga till</a> en.',
        'closed' => 'Platserna är för närvarande stängda, du kan inte reservera platser eller ändra reservationer.',
        'seatnotfound' => 'Kunde inte hitta platsen.',
        'seatingclosed' => 'Det går inte att reservera platser för tillfället.',
        'paymentexist' => 'Den här platsen har redan bokats.',
        'youcantpay' => 'Du kan inte betala för den här platsen.',
        'noreservation' => 'Det fanns ingen reservation för denna plats.',
        'carderror' => 'Kontrollera din kortinformation och försök igen.',
        'pleasetryagain' => 'Försök igen.',
        'seatpaid' => ':seatname är nu reserverad och betald! Vi är glada att ha dig, välkommen!',
        'seattemppaid' => ':seatname är nu markerad som betalning vid ingången! Vi är glada att ha med dig, välkommen!',
        'paymentcantchange' => 'Du kan inte ändra betalningen för din reservation efter de första 48 timmarna.',
        'youcanchangepayment' => 'Du kan nu ändra betalningen för din reservation.',
        'notpossibleonthisrow' => 'Det går inte att reservera platser på den här raden.',
        'unpaidinvoice' => 'Du har en eller flera obetalda fakturor, vänligen betala dessa först. Du kommer kunna reservera en plats när detta har åtgärdats.',
        'tickets' => 'För mer information om de olika biljetttyperna, besök <a href=":url">denna sida</a>.',
        'entrancepaymentnotallowed' => 'Den här biljetten kan inte betalas vid ingången. Betala med kort istället.',
    ),

    'closed' => 'Platskartan är inte tillgänglig för tillfället!',
    'checklater' => 'Var vänlig försök igen senare...',

    'map' => array(
        'scene' => 'Scen',
        'exit' => 'Utgång',
        'kiosk' => 'Kiosk',
        'available' => 'Tillgänglig',
        'unavailable' => 'Otillgänglig',
        'you' => 'Denna plats är reserverad för dig!',
        'reservedfor' => 'Reserverad för',
        'tempreserved' => 'Tillfälligt reserverad av',
    ),

    'reservation' => array(
        'none' => 'Du har inte reserverat några platser...',
        'your' => 'Dina Reservationer',
        'foryou' => 'Plats reserverad för dig',
        'expires' => 'Utgår',
        'paid' => 'Betald',
        'notpaidyet' => 'Ej betald än',
        'notpaidyetdesc' => 'Betala vid ingången',
        'notpaid' => 'Obetald',
        'view' => 'Visa plats',
        'pay' => 'Betala nu',
        'changepayment' => 'Ändra betalning',
        'download' => 'Ladda ner PDF-biljett',
        'ticket' => 'Visa digital biljett',
        'remove' => 'Ta bort reservation',
        'consentform' => array(
            'title' => 'Tillståndsformulär',
            'desc' => 'Personen som har denna reservation är reserverad för under 13 år och måste ha ett ifyllt samtyckesformulär vid incheckningen på evenemanget.',
            'why' => 'Varför ser jag detta?',
        ),
        'pizza' => array(
            'title' => 'Pizza',
            'desc' => 'Du får en pizza på evenemanget!',
        ),
        'alert' => array(
            'notpossibleonthisrow' => 'Det går inte att reservera platser på den här raden.',
            'alreadyreserved' => 'Platsen har redan blivit reserverad.',
            'youcannotpay' => 'Du kan inte betala för denna reservation, personen som reserverade den måste göra det.',
            'nobirthday' => 'Du måste ha en födelsedag kopplad till ditt konto för att kunna reservera en plats.',
            'noaddress' => 'Det verkar som att du inte har en adress kopplad till ditt konto.',
            'limit' => 'Du har nått reservationsgränsen. Du är inte tillåten att reservera fler platser.',
            'limitself' => 'Du kan inte reservera mer än en plats för dig själv. Välj en annan medlem som du vill reservera denna plats för.',
            'nobirthdayfor' => 'Det verkar som att :name inte har en födelsedag kopplad till sitt konto, de behöver det för att kunna reservera en plats.',
            'noaddressfor' => 'Det verkar som att :name inte har en adress kopplad till sitt konto. De kommer inte kunna reservera någon plats innan de har lagt till en adress.',
            'limitreservedfor' => ':name är inte tillåten att reservera fler platser.',
            'alreadyreservedfor' => ':name har redan reserverat en plats.',
            'success' => 'Du har nu framgångsrikt reserverat denna plats!',
            'failure' => 'Något gick fel när reservationen skulle sparas!',
            'ticketnoaccess' => 'Du har inte tillstånd att visa den här biljetten.',
            'destroy' => array(
                'notfound' => 'Kunde inte hitta reservationen.',
                'noaccess' => 'Du kan inte ta bort denna reservation.',
                'cantberemovedafter' => 'Du kan inte ta bort reservationen efter de första :hours timmarna.',
                'cantberemoved' => 'Du kan inte ta bort denna reservation efter att den är reserverad.',
                'success' => 'Reservationen har nu tagits bort!',
                'failure' => 'Något gick fel när reservationen skulle tas bort.',
            ),
        ),
    ),

    'show' => array(
        'seat' => 'Plats',
        'reserved' => 'Denna plats är :type för denna medlem.',
        'reservedfor' => 'Reserverad för',
        'agreement' => 'Jag har läst och godkänner <strong>Köpvillkoren</strong> och <strong>Reglerna</strong> för detta evenemang.',
        'button' => 'Reservera plats',
        'alert' => array(
            'cannotbereserved' => 'Denna plats kan inte reserveras!',
            'reservationlimit' => 'Du får inte reservera fler än <em>fem</em> platser.',
            'closed' => 'Platserna är för närvarande stängda, du kan inte reservera platser eller ändra reservationer.',
        ),
    ),

    'pay' => array(
        'title' => 'Betala för reservation',
        'price' => 'Pris',
        'tickettype' => 'Biljetttyp',
        'entrancebutton' => 'Betala vid ingången*',
        'entrancedesc' => '* <strong>Köpvillkor</strong> gäller',
        'or' => 'eller',
        'button' => 'Betala nu',
        'processing' => 'Behandlar betalning',
        'card' => array(
            'number' => 'KORTNUMMER',
            'expmonth' => 'UTGÅNGSMÅNAD',
            'expyear' => 'UTGÅNGSÅR',
            'cvc' => 'CVC',
            'name' => 'NAMN PÅ KORTET',
        ),
    ),

    'ticket' => array(
        'title' => 'Digital biljett',
        'checkin' => array(
            'title' => 'Din incheckningskod',
        ),
    ),

    'checkin' => array(
        'title' => 'Självincheckning',
        'subtitle' => 'Ange din incheckningskod här',
        'info' => 'Du måste ha verifierat din telefon, vara 13 år eller äldre och ha betalat för din biljett för att kunna använda självincheckningen.',
        'alert' => array(
            'success' => 'Lyckades!',
            'notfound' => 'Hittades inte.',
            'notallowed' => 'Du får inte använda självincheckning, antingen är du för ung, har inte verifierat din telefon eller har inte betalat.',
            'failed' => 'Självincheckningen misslyckades.',
        ),
    ),

];