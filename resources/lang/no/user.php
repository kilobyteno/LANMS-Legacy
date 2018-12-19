<?php

return [

    'adminpanel' => 'Administrasjonspanel',
    'profile' => 'Profil',

    'loggedin' => 'Velkommen tilbake!',
    'loggedout' => 'Nå har du blitt logget ut!',

    'alert' => array(
        'attendancelastyear' => 'Vi kan se at du deltok i fjor. Vil du bli med oss i år også? <a href=":url">Sjekk ut sitteområdet nå</a>.',
        'consentform' => 'Vi kan se at du er under 16 år og på arrangementet må ha med samtykkeskjema ferdig utfyllt ved innskjekking. Ferdig generert skjema finner du her: <a href=":url"><i class="fa fa-user-circle-o"></i> Samtykkeskjema</a>',
        'nobirthdate' => 'There is no birthdate assigned to your account, this is required from now on. <a href=":url">Edit your profile</a>',
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
        ),
        'referral' => array(
            'title' => 'Henvisning',
            'desc' => 'Dette er henvisningslinken du kan dele med vennene dine, dette vil spore tilbake til deg hvis du registrerer deg på dette nettstedet.',
            'users' => '{0} <em>Du har ikke henvist noen brukere ennå.</em>|{1} Du har henvist <strong>en</strong> bruker.|[2,*] Du har henvist <strong>:count</strong> brukere.',
        ),
        'changepassword' => array(
            'title' => 'Bytt passord',
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
            ),

            'settings' => array(
                'title' => 'Rediger innstillingene dine',
                'show' => 'Vis',
                'fullname' => 'Fullt navn',
                'onlinestatus' => 'Online status',
                'dateformat' => 'Datoformat',
                'timeformat' => 'Tidsformat',
            ),

            'confirmpassword' => array(
                'title' => 'Bekreft endringer med passordet ditt',
            ),

        ),

        'changeimages' => array(
            'title' => 'Endre profilbilder',
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
