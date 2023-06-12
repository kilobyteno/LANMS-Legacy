<?php

return [

    'adminpanel' => 'Administration',
    'profile' => 'Profil',

    'alert' => array(
        'attendancelastyear' => 'Vi ser att du deltog förra året. Vill du vara med oss även i år? <a href=":url">Kolla in sittplatserna nu</a>.',
        'consentform' => 'Vi ser att du är under 13 år och att ett tillståndsformulär måste fyllas i vid incheckningen. Du kan hitta det ifyllda formuläret här: <a href=":url"><i class="fas fa-user-circle"></i> Tillståndsformulär</a>',
        'nobirthdate' => 'Det finns inget födelsedatum sparat på ditt konto. Vi behöver detta för att bekräfta din identitet. <a href=":url">Redigera din profil</a>',
        'nophone' => 'Det finns inget telefonnummer sparat på ditt konto. Vi behöver ditt telefonnummer i händelse av en nödsituation under evenemanget. <a href=":url">Redigera din profil</a>',
    ),

    'dashboard' => array(
        'title' => 'Användare',
        'quicklinks' => array(
            'title' => 'Snabblänkar',
            'youraccount' => 'Ditt konto',
            'yourprofile' => 'Din profil',
            'changepassword' => 'Ändra lösenord',
        ),
    ),

    'account' => array(
        'title' => 'Konto',
        'identity' => 'Visa min identitet',
        'details' => array(
            'title' => 'Detaljer',
            'alert' => array(
                'saved' => 'Din profil har ändrats!',
                'failed' => 'Något gick fel när ändringen skulle sparas.',
                'wrongpassword' => 'Fel lösenord. Försök igen.',
            ),
            'editprofile' => 'Redigera profil',
            'images' => 'Byt profilbilder',
            'password' => 'Byt lösenord',
        ),
        'personaldata' => array(
            'title' => 'Personuppgifter',
        ),
        'reservations' => array(
            'title' => 'Bokningar',
            'viewreservation' => 'Visa bokning',
            'viewpayment' => 'Visa betalning',
            'reservation' => array(
                'title' => 'Bokning',
                'info' => 'Information',
                'actions' => 'Åtgärder',
                'downloadticket' => 'Ladda ner biljett',
                'downloadreceipt' => 'Ladda ner kvitto',
            ),
        ),
        'billing' => array(
            'title' => 'Fakturering',
            'alert' => array(
                'noaddress' => 'Det verkar som att det inte finns någon adress kopplad till detta konto. Det kommer inte vara möjligt att betala fakturor förrän det finns en adress kopplad till kontot. Du kan <a href=":url" class="alert-link">lägga till en här</a>.',
            ),
            'payments' => array(
                'title' => 'Betalningar',
                'payment' => array(
                    'title' => 'Betalning',
                    'downloadreceipt' => 'Ladda ner kvitto',
                ),
            ),
            'charges' => array(
                'title' => 'Avgifter',
            ),
            'invoice' => array(
                'title' => 'Faktura',
                'invoiceto' => 'Fakturera till',
                'status' => array(
                    'draft' => 'Utkast',
                    'open' => 'Öppen',
                    'paid' => 'Betald',
                    'void' => 'Ogiltig',
                    'uncollectible' => 'Går ej att betala!',
                    'scheduled' => 'Schemalagd',
                ),
                'event' => array(
                    'invoice' => array(
                        'created' => 'Utkastet till faktura har skapats.',
                        'updated' => 'Fakturan har uppdaterats.',
                        'finalized' => 'Utkastet till faktura har slutförts.',
                        'sent' => 'Fakturan har skickats.',
                        'marked_uncollectible' => 'Fakturan har markerats som icke betalbar.',
                        'voided' => 'Fakturan har ogiltigförklarats.',
                        'payment_failed' => 'Betalningen misslyckades.',
                        'payment_succeeded' => 'Betalningen lyckades.',
                    ),
                ),
                'product' => 'Produkt',
                'quantity' => 'Antal',
                'unitprice' => 'Enhetspris',
                'amount' => 'Belopp',
                'subtotal' => 'Delsumma',
                'discount' => 'Rabatt',
                'taxrate' => 'Skatt',
                'taxdue' => 'Skatt att betala',
                'totaldue' => 'Totalt att betala',
                'amountpaid' => 'Betalat belopp',
                'amountremaining' => 'Återstående belopp',
                'payinvoice' => 'Betala faktura',
                'printinvoice' => 'Skriv ut faktura',
                'explination' => 'Vi kommer att debitera <a href=":url" class="alert-link">standardkortet</a> som är kopplat till ditt konto för att ta hand om denna betalning.',
                'alert' => array(
                    'paid' => 'Denna faktura har nu blivit betald.',
                    'nocards' => 'Det finns inga kort kopplade till ditt konto. Du kan lägga till ett <a href=":url" class="alert-link">här</a>.',
                    'scheduled' => 'Denna utkastsfaktura kan redigeras fram tills den automatiskt slutförs om :time.'
                ),
            ),
            'card' => array(
                'title' => 'Kreditkort',
                'alert' => array(
                    'deleted' => 'Kortet har nu tagits bort.',
                    'added' => 'Kortet har nu lagts till.',
                ),
                'create' => array(
                    'title' => 'Lägg till kort',
                ),
            ),
        ),
        'referral' => array(
            'title' => 'Vill du bjuda in dina vänner?',
            'desc' => 'Ge dem denna länk. Använder dem din länk kommer det att spåras tillbaka till dig. Kanske finns det en belöning?',
            'users' => '{0} <em>Du har inte rekryterat några användare ännu.</em>|{1} Du har rekryterat <strong>en</strong> användare.|[2,*] Du har rekryterat <strong>:count</strong> användare.',
        ),
        'changepassword' => array(
            'title' => 'Byt lösenord',
            'alert' => array(
                'saved' => 'Ditt lösenord har ändrats! Vänligen logga in igen för att bekräfta lösenordsändringen.',
                'failed' => 'Något gick fel när lösenordet skulle sparas.',
                'wrongpassword' => 'Ditt nuvarande lösenord verkar inte stämma.',
            ),
            'editpassword' => 'Redigera ditt lösenord',
'button' => 'Uppdatera lösenord',
        ),
        'verifyphone' => array(
            'title' => 'Verifiera telefon',
            'alert' => array(
                'saved' => 'Telefonnumret verifierades framgångsrikt.',
                'failed' => 'Verifiering misslyckades!',
                'nophone' => 'Inget telefonnummer sparades.',
                'alreadyverified' => 'Telefonen har redan verifierats.',
                'info' => 'Verifieringstoken har skickats! Vänligen vänta upp till en minut.',
            ),
            'typecode' => 'Skriv in koden du fick via SMS',
            'button' => 'Verifiera',
        ),
    ),

    'profile' => array(
        'title' => 'Profil',
        'myprofile' => 'Min profil',
        'editprofile' => 'Redigera profil',
        'editimages' => 'Redigera bilder',
        'noattendance' => 'Inget deltagande ännu.',
        'alert' => array(
            'userdeleted' => 'Denna användare har raderats.',
        ),
        'activity' => array(
            'title' => 'Aktivitet',
            'reservedaseatfor' => 'Reserverade en plats för <strong>:Namn</strong>',
        ),
        'edit' => array(
            'title' => 'Redigera profil',
            'button' => 'Uppdatera profil',

            'details' => array(
                'title' => 'Redigera dina profiluppgifter',
                'phonewhy' => 'Varför?',
                'phonewhydesc' => 'Vi behöver ditt telefonnummer i händelse av en nödsituation under evenemanget.',
            ),

            'address' => array(
                'title' => 'Redigera din adress',
            ),

            'settings' => array(
                'title' => 'Redigera dina inställningar',
                'show' => 'Visa',
                'fullname' => 'Fullständigt namn',
                'onlinestatus' => 'Onlinestatus',
                'language' => 'Föredraget språk',
                'theme' => 'Föredraget tema',
                '2fa' => array(
                    'title' => 'Tvåfaktorsautentisering',
                    'desc' => 'Vänligen ange OTP-koden som skickades till ditt telefonnummer',
                    'disabled' => 'Du måste verifiera ditt telefonnummer innan du kan aktivera 2FA!',
                    'info' => 'Vi använder Authy för 2FA och rekommenderar starkt att du använder <a class="alert-link" href=":url">Authy-appen</a>.',
                    'alert' => array(
                        'activated' => 'Tvåfaktorsautentisering är nu aktiverat!',
                        'deactivated' => 'Tvåfaktorsautentisering är inaktiverat!',
                        'missingenv' => 'Tvåfaktorsautentisering är inte aktiverat av administratören!',
                    ),
                ),
            ),

            'confirmpassword' => array(
                'title' => 'Bekräfta ändringar med ditt lösenord',
            ),

        ),

        'changeimages' => array(
            'title' => 'Ändra profilbilder',
            'alert' => array(
                'saved' => 'Din bild har laddats upp!',
                'failed' => 'Din bild kunde inte laddas upp.',
                'noimage' => 'Vänligen välj en bild.',
            ),
            'button' => 'Ladda upp bild',
            'coverphoto' => 'Omslagsfoto',
            'profilephoto' => 'Profilfoto',
        ),
        
    ),

    'gdpr' => array(
        'delete' => array(
            'title' => 'Radera personuppgifter',
            'alert' => array(
                'saved' => 'Ditt konto har nu raderats!',
            ),
            'message' => '<p>Vi beklagar att se dig gå!</p>
                    <p>När du klickar på radera-knappen kommer ditt konto och all dess data raderas för alltid. Det kommer inte att gå att återställa någon data kopplad till detta konto.</p>
                    <p>Se till att du <a href=":url">laddar ner din data</a> innan du raderar ditt konto.</p>
                    <p>Att radera ditt konto anonymiserar din profil och tar bort ditt namn och foto från de flesta saker som ditt konto är kopplat till.</p>',
            'password' => 'När du är redo att radera ditt konto, skriv in ditt lösenord här',
            'iamsure' => 'Ja, jag är säker på att jag vill radera mitt konto!',
            'button' => 'Radera mitt konto',
        ),
        'download' => array(
            'title' => 'Ladda ner personuppgifter',
            'message' => 'För att ladda ner all din personliga data måste du bekräfta ditt lösenord.',
        ),
        'message' => array(
            'title' => 'GDPR-avtal',
            'alert' => array(
                'saved' => 'Ditt val har sparats.',
                'denied' => 'Du måste acceptera det nya avtalet för att använda denna tjänst. Detta beror på de nya GDPR-reglerna.',
            ),
            'question' => 'Godkänner du dessa nya ändringar?',
            'iconsent' => 'Jag samtycker',
            'ideny' => 'Jag nekar till dessa ändringar',
            'agreement' => "<p>Det är troligt att du har hört talas om GDPR, men vad innebär förordningen för dig som medlem? Här kan du läsa om vad dataskyddsreformen innebär för ditt medlemskap på denna webbplats.</p>

                    <p><strong>Vad är GDPR?</strong></p>
                    <p>EU:s nya dataskyddsreform, mer känt som GDPR (General Data Protection Regulation), har skapats för att förbättra din dataskydd över EU:s och EES-ländernas landgränser. Sekretessen prioriteras på denna webbplats, och i den här artikeln hittar du information om hur vi arbetar för att följa den nya integritetspolicyn.</p>

                    <p><strong>En tryggare gemenskap för dig som medlem</strong></p>
                    <p>Den nya förordningen är en del av den svenska lagstiftningen och är ett ytterligare skydd för att dina personuppgifter behandlas lagligt. Denna webbplats får ett större ansvar för att behandla och säkra dina medlemsuppgifter, samtidigt som du kommer att kunna genomföra dina onlineköp på samma sätt som tidigare. Med andra ord är GDPR bara till fördel för dig som medlem.</p>

                    <p><strong>Ditt samtycke är klart</strong></p>
                    <p>Ditt nuvarande samtycke är fortfarande giltigt. Det nya är att du nu kan välja om du vill ta emot erbjudanden och nyheter via e-post och att informationen om ditt samtycke och vad det innebär är uppdaterad.</p>
                    <p>Du kan när som helst dra tillbaka ditt samtycke. För att få en översikt eller göra ändringar i ditt samtycke kan du enkelt gå till \"Mitt konto\". Du kan också avsluta prenumerationen på e-postmeddelanden.</p>

                    <p><strong>Samordnare och tredje part</strong></p>
                    <p>Ordföranden för detta evenemang är generellt ansvarig för evenemangets behandling av personuppgifter. För att erbjuda en skräddarsydd köpupplevelse för dig använder denna webbplats externa samarbetspartners, men dina personuppgifter försummas eller säljs inte till tredje part. Här kan du läsa mer om vår behandling av personuppgifter.</p>

                    <p><strong>Integritetspolicy</strong></p>
                    <p>I samband med GDPR har vi anpassat och förenklat vår integritetspolicy. Här kan du läsa detaljerat om hur vi behandlar dina personuppgifter och vilka typer av information det handlar om. Policyn informerar dig om kunddata du tillhandahåller vid användning av denna webbplats och kontaktuppgifterna för informationen internt i vårt system.</p>

                    <p><strong>Ökad säkerhet för dina kunddata</strong></p>
                    <p>Den nya direktivet kräver att denna webbplats har full översikt över alla evenemangets personuppgifter och kräver säkerhet för dessa. Vid en dataläcka som kan påverka dina personuppgifter följer denna webbplats reglerna om rapporteringsskyldighet enligt GDPR.</p>",
        ),
    ),

];
