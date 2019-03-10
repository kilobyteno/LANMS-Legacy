<?php

return [

    'adminpanel' => 'Administrasjonspanel',
    'profile' => 'Profil',

    'alert' => array(
        'attendancelastyear' => 'Vi kan se at du deltok i fjor. Vil du bli med oss i år også? <a href=":url">Sjekk ut sitteområdet nå</a>.',
        'consentform' => 'Vi kan se at du er under 16 år og på arrangementet må ha med samtykkeskjema ferdig utfyllt ved innskjekking. Ferdig generert skjema finner du her: <a href=":url"><i class="fas fa-user-circle"></i> Samtykkeskjema</a>',
        'nobirthdate' => 'Det er ingen fødselsdato lagret på kontoen din. Vi trenger dette for å bekrefte din identitet. <a href=":url">Rediger profilen din</a>',
        'nophone' => 'Det er ikke noe telefonnummer lagret på kontoen din. Vi trenger telefonnummeret ditt i tilfelle det skulle oppstå et nødstilfelle under arrangementet. <a href=":url">Rediger profilen din</a>',
    ),

    'dashboard' => array(
        'title' => 'Bruker',
        'quicklinks' => array(
            'title' => 'Hurtigkoblinger',
            'youraccount' => 'Kontoen din',
            'yourprofile' => 'Profilen din',
            'changepassword' => 'Bytt passord',
        ),
    ),

    'account' => array(
        'title' => 'Konto',
        'details' => array(
            'title' => 'Detaljer',
            'alert' => array(
                'saved' => 'Dine detaljer er endret!',
                'failed' => 'Noe gikk galt når du lagret dine detaljer.',
                'wrongpassword' => 'Feil passord. Vær så snill, prøv på nytt.',
            ),
            'editprofile' => 'Rediger profil',
            'images' => 'Endre profilbilder',
            'addressbook' => 'Administrer adressebok',
            'password' => 'Bytt passord',
        ),
        'personaldata' => array(
            'title' => 'Personlig informasjon',
        ),
        'reservations' => array(
            'title' => 'Reservasjoner',
            'viewreservation' => 'Vis reservasjon',
            'viewpayment' => 'Vis betaling',
            'reservation' => array(
                'title' => 'Reservasjon',
                'info' => 'Info',
                'actions' => 'Handlinger',
                'downloadticket' => 'Last ned billett',
                'downloadreceipt' => 'Last ned kvittering',
            ),
        ),
        'billing' => array(
            'title' => 'Fakturering',
            'alert' => array(
                'noaddress' => 'Det ser ut til at det ikke er adresser knyttet til denne kontoen. Det vil ikke være mulig å betale for fakturaer før det er en adresse på denne kontoen. Du kan <a href=":url" class="alert-link">legge til en her</a>.',
            ),
            'payments' => array(
                'title' => 'Betalinger',
                'payment' => array(
                    'title' => 'Innbetaling',
                    'downloadreceipt' => 'Last ned kvittering',
                ),
            ),
            'charges' => array(
                'title' => 'Belastninger',
            ),
            'invoice' => array(
                'title' => 'Faktura',
                'invoiceto' => 'Faktura til',
                'status' => array(
                    'draft' => 'Utkast',
                    'open' => 'Åpen',
                    'paid' => 'Betalt',
                ),
                'product' => 'Produkt',
                'quantity' => 'Antall',
                'unitprice' => 'Enhetspris',
                'amount' => 'Beløp',
                'subtotal' => 'Sub Total',
                'discount' => 'Discount',
                'taxrate' => 'MVA-sats',
                'taxdue' => 'Merverdiavgift',
                'totaldue' => 'Samlet beløp',
                'amountpaid' => 'Beløp betalt',
                'amountremaining' => 'Beløp gjenstående',
                'payinvoice' => 'Betal faktura',
                'printinvoice' => 'Skriv ut faktura',
                'explination' => 'Vi belaster <a href=":url" class="alert-link">standardkortet</a> som er lagt til på kontoen din for å ta betalingen på denne fakturaen.',
                'alert' => array(
                    'paid' => 'Denne fakturaen er nå betalt.',
                    'nocards' => 'Det er ingen kort knyttet til kontoen din. Du kan legge til en <a href=":url" class="alert-link">her</a>.',
                ),
            ),
            'card' => array(
                'title' => 'Kredittkort',
                'alert' => array(
                    'deleted' => 'Kortet er nå slettet.',
                    'added' => 'Kortet er nå lagt til.',
                ),
                'create' => array(
                    'title' => 'Legg til kort',
                ),
            ),
        ),
        'referral' => array(
            'title' => 'Henvisning',
            'desc' => 'Dette er henvisningslinken du kan dele med vennene dine, dette vil spore tilbake til deg hvis de registrerer seg på dette nettstedet.',
            'users' => '{0} <em>Du har ikke henvist noen brukere ennå.</em>|{1} Du har henvist <strong>en</strong> bruker.|[2,*] Du har henvist <strong>:count</strong> brukere.',
        ),
        'changepassword' => array(
            'title' => 'Bytt passord',
            'alert' => array(
                'saved' => 'Ditt passord har blitt endret! Vennligst logg inn igjen for å bekrefte passordendringen.',
                'failed' => 'Noe gikk galt når du lagret dine detaljer.',
                'wrongpassword' => 'Ditt nåværende passord ser ikke ut til å samsvare.',
            ),
            'editpassword' => 'Rediger passordet ditt',
            'button' => 'Oppdater passord',
        ),
    ),

    'profile' => array(
        'title' => 'Profil',
        'myprofile' => 'Min profil',
        'attendance' => 'Deltakelse',
        'editprofile' => 'Rediger profil',
        'editimages' => 'Rediger bilder',
        'reservedaseatfor' => 'Reserverte et sete for',
        'noattendance' => 'Ingen oppmøte ennå.',
        'alert' => array(
            'userdeleted' => 'Denne brukeren er slettet.',
        ),
        'edit' => array(
            'title' => 'Rediger profil',
            'button' => 'Oppdater profil',

            'details' => array(
                'title' => 'Rediger profilinformasjonen din',
                'phonewhy' => 'Hvorfor?',
                'phonewhydesc' => 'Vi trenger telefonnummeret ditt i tilfelle det skulle oppstå et nødstilfelle under arrangementet.',
            ),

            'settings' => array(
                'title' => 'Rediger innstillingene dine',
                'show' => 'Vis',
                'fullname' => 'Fullt navn',
                'onlinestatus' => 'Online status',
                'language' => 'Ønsket Språk',
                'theme' => 'Ønsket Tema',
            ),

            'confirmpassword' => array(
                'title' => 'Bekreft endringer med passordet ditt',
            ),

        ),

        'changeimages' => array(
            'title' => 'Endre profilbilder',
            'alert' => array(
                'saved' => 'Bildet ditt er lastet opp!',
                'failed' => 'Bildet ditt kunne ikke lastes opp.',
                'noimage' => 'Vennligst velg et bilde.',
            ),
            'button' => 'Last opp bilde',
            'coverphoto' => 'Forsidebilde',
            'profilephoto' => 'Profilbilde',
        ),
        
    ),

    'addressbook' => array(
        'title' => 'Adressebok',
        'address' => 'Adresse',
        'noaddress' => 'Vi kan ikke finne noen adresser knyttet til kontoen din. Du bør <a href=":url">legge til</a> en.',
        'areyousure' => 'Er du sikker på at du vil slette denne adressen?',
        'primaryaddress' => 'Jeg vil ha dette som min primær adresse',
        'confirmchanges' => 'Bekreft endringer med passordet ditt',
        'alert' => array(
            'nodeletewhilereservation' => 'Du vil ikke kunne slette adresser mens du har reserverte plasser.',
            'saved' => 'Adressen er nå lagt til!',
            'updated' => 'Adressen er nå oppdatert!',
            'deleted' => 'Adressen er nå slettet!',
            'failed' => 'Noe gikk galt mens du lagret adressen til adresseboken.',
            'wrongpassword' => 'Ditt nåværende passord ser ikke ut til å samsvare.',
        ),
        'swal' => array(
            'title' => 'Ingenting har blitt gjort.',
            'text' => 'Adressen ble ikke slettet!',
        ),
        'create' => array(
            'title' => 'Legg til adresse',
        ),
        'edit' => array(
            'title' => 'Rediger adresse',
        ),
    ),

    'gdpr' => array(
        'delete' => array(
            'title' => 'Slett personopplysninger',
            'alert' => array(
                'saved' => 'Kontoen din er nå slettet!',
            ),
            'message' => '<p>Vi beklager å se deg gå!</p>
                    <p>Når du klikker på sletteknappen, vil kontoen din og alle dataene bli slettet for alltid. Det kan ikke gjenopprette data som er knyttet til denne kontoen.</p>
                    <p>Sørg for at du <a href=":url">laster ned dataene dine</a> før du sletter kontoen din.</p>
                    <p>Hvis du sletter kontoen din, vil du anonymisere profilen din og fjerne navnet ditt og bildet fra de fleste tingene som kontoen din er koblet til.</p>',
            'password' => 'Når du er klar til å slette kontoen din, skriver du inn passordet ditt her',
            'iamsure' => 'Ja, jeg er sikker på at jeg vil slette kontoen min!',
            'button' => 'Slett kontoen min',
        ),
        'download' => array(
            'title' => 'Last ned personlige data',
            'message' => 'For å laste ned alle dine personlige data må du bekrefte passordet ditt.',
        ),
        'message' => array(
            'title' => 'GDPR-avtalen',
            'alert' => array(
                'saved' => 'Ditt valg har blitt lagret.',
                'denied' => 'Du må godta den nye avtalen for å bruke denne tjenesten. Dette er på grunn av de nye GDPR-reglene.',
            ),
            'question' => 'Samtykker du i disse nye endringene?',
            'iconsent' => 'Jeg samtykker',
            'ideny' => 'Jeg nekter disse endringene',
            'agreement' => "<p>Sannsynligvis har du hørt om GDPR, men hva betyr reguleringen for deg som medlem? Her kan du lese om hva personvernreformen innebærer for medlemskapet ditt på denne nettsiden.</p>

                    <p><strong>Hva er GDPR?</strong></p>
                    <p>EUs nye personvernreform, bedre kjent som GDPR (General Data Protection Regulation), er opprettet for å forbedre datasikkerheten din over europeiske landgrenser i EU og EØS-landene. Personvern er prioritert på denne nettsiden, og i denne artikkelen finner du informasjon om hvordan vi jobber for å overholde den nye personvernpolitikken.</p>

                    <p><strong>Et tryggere fellesskap for deg som medlem</strong></p>
                    <p>Den nye forskriften blir en del av norsk lovgivning, og er en tilleggsforsikring om at din personlige informasjon behandles lovlig. Det vil være større ansvar på denne nettsiden for behandling og sikring av medlemsdata, samtidig som du vil kunne utføre online shopping på samme måte som før. Med andre ord, GDPR er bare en fordel for deg som medlem.</p>

                    <p><strong>Ditt samtykke er klart</strong></p>
                    <p>Ditt nåværende samtykke er fortsatt gyldig. Det nye er at du nå kan velge om du vil motta tilbud og nyheter via e-post, og at informasjonen om ditt samtykke og hva det innebærer, er oppdatert.</p>
                    <p>Du kan når som helst trekke tilbake samtykket ditt. For å få oversikt eller endringer i ditt samtykke, kan du enkelt gå til \"Min konto\". Du kan også avmelde fra e-post.</p>

                    <p><strong>Koordinator og tredjepart</strong></p>
                    <p>Formannen for dette arrangementet er generelt ansvarlig for arrangementets behandling av personopplysninger. For å skaffe en skreddersydd oppkjøpserfaring for deg, bruker dette nettstedet eksterne partnere, men dine personopplysninger er på ingen måte forsømt eller solgt til tredjepart. Her kan du lese mer om vår behandling av personopplysninger.</p>

                    <p><strong>Personvernregler</strong></p>
                    <p>I forbindelse med GDPR har vi tilpasset og forenklet vår personvernerklæring. Her kan du lese detaljert hvordan vi behandler dine personlige opplysninger og hvilke typer informasjon det gjelder. Erklæringen informerer deg om kundedataene du oppgir under bruken av dette nettstedet og kontaktpunktene for informasjonen internt i vårt system.</p>

                    <p><strong>Økt sikkerhet for kundedataene dine</strong></p>
                    <p>Det nye direktivet krever at dette nettstedet skal ha en fullstendig oversikt over alle arrangementets personopplysninger og kreve sikkerhet for disse. I tilfelle datautbrudd, som kan påvirke dine personlige opplysninger, følger denne nettsiden reglene for rapporteringstoll oppgitt i GDPR.</p>",
        ),
    ),

];
