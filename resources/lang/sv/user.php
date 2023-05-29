<?php

return [

    'adminpanel' => 'Administration',
    'profile' => 'Profil',

    'alert' => array(
        'attendancelastyear' => 'Vi kan se att du var med förra året. Vill du vara med även detta år? <a href=":url">Kolla in platskartan!</a>.',
        'consentform' => 'Vi kan se att du är under 10. Du behöver därför fylla i ett samtyckesformulär. Du kan hitta formuläret här: <a href=":url"><i class="fas fa-user-circle"></i>Samtyckesformulär</a>',
        'nobirthdate' => 'Det finns inget födelsedatum registrerat på ditt konto. Vi behöver det för att validera din identitet. <a href=":url">Redigera din profil!</a>',
        'nophone' => 'Det finns inget telefonnummer registrerat på din profil. Vi behöver det t.ex. om det skulle hända något under evenemanget. <a href=":url">Redigera din profil!</a>',
    ),

    'dashboard' => array(
        'title' => 'Användare',
        'quicklinks' => array(
            'title' => 'Snabblänkar',
            'youraccount' => 'Ditt konto',
            'yourprofile' => 'Din profil',
            'changepassword' => 'Byt lösenord',
        ),
    ),

    'account' => array(
        'title' => 'Konto',
        'identity' => 'Visa min identitet',
        'details' => array(
            'title' => 'Uppgifter',
            'alert' => array(
                'saved' => 'Dina uppgifter har ändrats!',
                'failed' => 'Något gick fel när vi skulle ändra dina uppgifter. Försök igen senare.',
                'wrongpassword' => 'Fel lösenord! Försök igen.',
            ),
            'editprofile' => 'Redigera profil',
            'images' => 'Byt profilbild',
            'password' => '',
        ),
        'personaldata' => array(
            'title' => 'Dina uppgifter',
        ),
        'reservations' => array(
            'title' => 'Bokningar',
            'viewreservation' => 'Visa bokningar',
            'viewpayment' => 'Visa betalning',
            'reservation' => array(
                'title' => 'Bokning',
                'info' => 'Information',
                'actions' => 'Handlingar',
                'downloadticket' => 'Ladda ner biljett',
                'downloadreceipt' => 'Ladda ner kvitto',
            ),
        ),
        'billing' => array(
            'title' => 'Fakturering',
            'alert' => array(
                'noaddress' => 'Det verkar som att det inte finns någon adress registrerad på detta konto. Du kommer inte kunna betala dina avgifter. Lägg till en adress <a href=":url" class="alert-link">här.</a>.',
            ),
            'payments' => array(
                'title' => 'Betalningar',
                'payment' => array(
                    'title' => 'Betalning',
                    'downloadreceipt' => 'Ladda ner kvitto',
                ),
            ),
            'charges' => array(
                'title' => 'Kostnader',
            ),
            'invoice' => array(
                'title' => 'Faktura',
                'invoiceto' => 'Faktura till',
                'status' => array(
                    'draft' => 'Utkast',
                    'open' => 'Öppen',
                    'paid' => 'Betald',
                    'void' => 'Ogiltig',
                    'uncollectible' => 'Misslyckad',
                    'scheduled' => 'Schemalagd',
                ),
                'event' => array(
                    'invoice' => array(
                        'created' => 'Din faktura har sparats som utkast.',
                        'updated' => 'Fakturan är uppdaterad.',
                        'finalized' => 'Ditt utkast är nu slutfört.',
                        'sent' => 'Fakturan är skickad.',
                        'marked_uncollectible' => 'Fakturan har en misslyckad betalning.',
                        'voided' => 'Fakturan är ogiltig.',
                        'payment_failed' => 'Betalning misslyckades!',
                        'payment_succeeded' => 'Betalning lyckades!.',
                    ),
                ),
                'product' => 'Produkt',
                'quantity' => 'Antal',
                'unitprice' => 'á pris',
                'amount' => 'Antal',
                'subtotal' => 'Delsumma',
                'discount' => 'Rabatt',
                'taxrate' => 'Skatt',
                'taxdue' => 'Skatt som skall betalas',
                'totaldue' => 'Totalt som ska betalas',
                'amountpaid' => 'Belopp betalt',
                'amountremaining' => 'Kvarstående belopp',
                'payinvoice' => 'Betala faktura',
                'printinvoice' => 'Skriv ut faktura',
                'explination' => 'Vi kommer att göra en dragning från <a href=":url" class="alert-link">ditt sparade kontokort</a> som du lade till på din profil.',
                'alert' => array(
                    'paid' => 'Fakturan är nu betald.',
                    'nocards' => 'Det finns inga betalkort registrerat på detta konto. Du kan lägga till ett <a href=":url" class="alert-link">här</a>.',
                    'scheduled' => 'Detta utkast kan redigeras tills :time då den automatiskt slutförs.'
                ),
            ),
            'card' => array(
                'title' => 'Kreditkort',
                'alert' => array(
                    'deleted' => 'Ditt kort är nu raderat.',
                    'added' => 'Du har nu lagt till ett nytt betalkort.',
                ),
                'create' => array(
                    'title' => 'Lägg till kort',
                ),
            ),
        ),
        'referral' => array(
            'title' => 'Bjud in dina vänner!',
            'desc' => 'Detta är din personliga inbjudningslänk, då kan vi se att just du har bjudit in fler personer.',
            'users' => '{0} <em>Du har inte bjudit in några personer ännu.</em>|{1} Du har bjudit in <strong>en</strong> person.|[2,*] Du har bjudit in <strong>:count</strong> användare.',
        ),
        'changepassword' => array(
            'title' => 'Byt lösenord',
            'alert' => array(
                'saved' => 'Ditt lösenord har ändrats! Logga in igen.',
                'failed' => 'Något gick fel när vi skulle spara dina uppgifter.',
                'wrongpassword' => 'Din nuvarande lösenord verkar vara fel.',
            ),
            'editpassword' => 'Ändra lösenord',
            'button' => 'Uppdatera lösenord',
        ),
        'verifyphone' => array(
            'title' => 'Verifiera telefonnummer',
            'alert' => array(
                'saved' => 'Verifieringen lyckades!',
                'failed' => 'Verifieringen misslyckades!',
                'nophone' => 'Det finns inget telefonnummer sparat på profilen.',
                'alreadyverified' => 'Detta nummer är redan verifierat.',
                'info' => 'Verifieringen är redan skickad. Vänta en minut sedan prova igen. ',
            ),
            'typecode' => 'Skicka koden som du fått av oss på SMS.',
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
            'userdeleted' => 'Den här användaren har blivit raderad.',
        ),
        'activity' => array(
            'title' => 'Aktivitet',
            'reservedaseatfor' => '<strong>:Name</strong> bokade plats för',
        ),
        'edit' => array(
            'title' => 'Redigera profil',
            'button' => 'Uppdatera profil',

            'details' => array(
                'title' => 'Redigera Uppgifter',
                'phonewhy' => 'Varför?',
                'phonewhydesc' => 'Vi behöver ditt telefonnummer om något skulle hända innan, under eller efter evenemanget.',
            ),

            'address' => array(
                'title' => 'Redigera adress',
            ),

            'settings' => array(
                'title' => 'Inställningar',
                'show' => 'Visa',
                'fullname' => 'Fullständigt namn',
                'onlinestatus' => 'Online Status',
                'language' => 'Språk',
                'theme' => 'Tema',
                '2fa' => array(
                    'title' => 'Two Factor Authentication',
                    'desc' => 'Skriv in OTP-koden vi skickat till dig på SMS.',
                    'disabled' => 'Du behöver verifiera ditt telefonnummer innan du kan aktivera 2FA!',
                    'info' => 'Vi använder "Authy" för 2FA och rekommenderar <a class="alert-link" href=":url">Authy appen</a>.',
                    'alert' => array(
                        'activated' => 'Two-factor authentication is now enabled!',
                        'deactivated' => 'Two-factor authentication is disabled!',
                        'missingenv' => 'Two-factor authentication is not activated by the administrator!',
                    ),
                ),
            ),

            'confirmpassword' => array(
                'title' => 'Bekräfta ändring av lösenord',
            ),

        ),

        'changeimages' => array(
            'title' => 'Byt profilbild',
            'alert' => array(
                'saved' => 'Din bild har laddats upp!',
                'failed' => 'Vi kunde inte ladda upp din bild. Försök igen.',
                'noimage' => 'Välj en bild.',
            ),
            'button' => 'Ladda upp',
            'coverphoto' => 'Omslagsbild',
            'profilephoto' => 'Profilbild',
        ),
        
    ),

    'gdpr' => array(
        'delete' => array(
            'title' => 'Ta bort din personliga data',
            'alert' => array(
                'saved' => 'Ditt konto är nu borttaget!!',
            ),
            'message' => '<p>Vi är ledsna att se dig lämna oss!</p>
                    <p>När du klickar på raderingsknappen kommer ditt konto och all dess data att raderas för alltid. Vi kommer inte att kunna återställa någon data kopplad till det här kontot.</p>
                    <p>St till att du <a href=":url">laddar ner din data</a> innan du raderar ditt konto.</p>
                    <p>Att ta bort ditt konto kommer att anonymisera din profil och ta bort ditt namn och foto från det mesta som ditt konto är kopplat till.</p>',
            'password' => 'När du är redo att ta bort ditt konto, skriv in ditt lösenord här.',
            'iamsure' => 'Ja, jag är säker!',
            'button' => 'Ta bort mitt konto',
        ),
        'download' => array(
            'title' => 'Ladda ner personlig data',
            'message' => 'För att ladda ner din personliga data, var vänlig skriv in ditt lösenord.',
        ),
        'message' => array(
            'title' => 'GDPR Avtal',
            'alert' => array(
                'saved' => 'Ditt val har sparats.',
                'denied' => 'Du måste acceptera det nya avtalet för att använda den här tjänsten. Detta pågrund av de nya reglerna med GDPR.',
            ),
            'question' => 'Godkännder du de nya ändringarna?',
            'iconsent' => 'Jag godkänner',
            'ideny' => 'Jag avstår',
            'agreement' => "<p>Förmodligen har du hört talas om GDPR, men vad betyder förordningen för dig som medlem? Här kan du läsa om vad integritetsreformen innebär för ditt medlemsskap på denna webbplats.</p>

                    <p><strong>Vad är GDPR?</strong></p>
                    <p>EU:s nya integritetsreform, mer känd som GDPR (General Data Protection Regulation), är skapad för att förbättra din datasäkerhet över europeiska landgränser i EU- och EES-länder. Sekretess är prioriterat på denna webbplats och på den här sidan hittar du information om hur vi arbetar för att följa den nya integritetspolicyn.
</p>

                    <p><strong>En tryggare plattform för dig som medlem</strong></p>
                    <p>Den nya förordningen blir en del av den svenska lagstiftningen, och är en ytterligare försäkran om att dina personuppgifter behandlas lagligt. Det kommer att finnas ett större ansvar på denna webbplats för att behandla och säkra dina medlemsuppgifter samtidigt som du kommer att kunna bedriva din näthandel på samma sätt som tidigare. GDPR är med andra ord bara en fördel för dig som medlem.</p>

                    <p><strong>Ditt samtycke är redo</strong></p>
                    <p>Ditt nuvarande samtycke är fortfarande giltigt. Nu kan du välja om du vill ta emot erbjudanden och nyheter via e-post och att informationen om ditt samtycke och vad det innebär är uppdaterad.</p>
                    <p>Du kan när som helst återkalla ditt samtycke. För att få en överblick eller göra ändringar i ditt samtycke kan du enkelt gå in på \"Mitt konto\". Du kan också avregistrera dig från e-postmeddelanden.</p>

                    <p><strong>Samordnare och tredje part</strong></p>
                    <p>Arrangören för detta evenemang är generellt ansvarig för evenemangets behandling av personuppgifter. För att ge dig en skräddarsydd användarupplevelse använder denna webbplats externa partners, men dina personuppgifter missköts inte eller säljs till tredje part. Här kan du läsa mer om vår behandling av personuppgifter.</p>

                    <p><strong>Integritetspolicy</strong></p>
                    <p>I samband med GDPR har vi anpassat och förenklat vår integritetspolicy. Här kan du läsa i detalj hur vi behandlar dina personuppgifter och vilken typ av information det rör sig om. Detta informerar dig om de kunduppgifter du lämnar under användningen av denna webbplats och kontaktpunkterna för informationen internt i vårt system.</p>

                    <p><strong>Ökad säkerhet för din kunddata</strong></p>
                    <p>Det nya direktivet kräver att denna webbplats har full överblick över alla evenemangets personuppgifter och kräver säkerhet för dessa. I händelse av ett dataavbrott, vilket kan påverka dina personuppgifter, följer denna webbplats reglerna för rapporteringsplikt som anges i GDPR.</p>",
        ),
    ),

];
