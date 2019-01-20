<?php

return [

    'alert' => array(
        'loggedin' => 'Velkommen tilbake!',
        'loggedout' => 'Nå har du blitt logget ut!',
        'logindisabled' => 'Innlogging og registrering har blitt deaktivert for øyeblikket. Vennligst sjekk tilbake senere!',
        'usernotfound' => 'Brukeren ble ikke funnet.',
        'isanonymized' => 'Denne kontoen er slettet.',
        'usernotactive' => 'Brukeren din er ikke aktiv! Vennligst sjekk innboksen din for aktiverings-e-posten. Sjekk også spam-mappen.',
        'accountnotactive' => 'Kontoen er ikke aktivert!',
        'loginfailed' => 'Kunne ikke logge deg på. Prøv igjen.',
        'usernamepasswordwrong' => 'Brukernavn eller passord var feil. Vær så snill, prøv på nytt.',
        'throttle' => 'Din IP er blokkert i :delay sekund(er).',
        'usernametaken' => 'Brukernavnet er allerede i bruk.',
        'emailtaken' => 'E-posten er allerede i bruk.',
        'emailfailure' => 'Noe gikk galt under forsøk på å sende deg en e-post. Men du har blitt registrert.',
        'accountcreated' => 'Din konto er opprettet, sjekk e-posten din for aktiveringslenken. Dobbelt sjekk på spam-mappen.',
        'creationfailure' => 'Noe gikk galt under forsøk på å registrere brukeren.',
        'activationfailure' => 'Vi kunne ikke finne din aktiveringskode. Prøv på nytt.',
        'usernameactivationfailure' => 'Brukernavn og aktiveringskode stemmer ikke overens.',
        'accountactivated' => 'Kontoen din har blitt aktivert!',
        'accountactivationfailure' => 'Noe gikk galt mens du aktiverte kontoen din. Prøv igjen senere.',
    ),

    'signout' => 'Logg ut',

    'signin' => array(
        'title' => 'Logg deg på kontoen din',
        'username' => 'E-post eller brukernavn',
        'rememberme' => 'Husk meg',
        'forgot' => 'Jeg glemte passordet mitt',
        'resend' => 'Send aktiverings e-post igjen',
        'button' => 'Logg inn',
    ),

    'signup' => array(
        'title' => 'Opprette ny konto',
        'dateofbirth' => 'Fødselsdato',
        'agreement' => 'Jeg har lest og er enig i<br><strong>Vilkår for bruk og Personvern</strong>',
        'button' => 'Registrer',
        'button_alt' => 'Opprett ny konto',
        'haveaccount' => 'Har du allerede konto?',
    ),

    'activate' => array(
        'title' => 'Aktiver konto',
        'username' => 'Bekreft e-post eller brukernavn',
        'forgetit' => 'Glem det, <a href=":url">send meg tilbake</a> til påloggingssiden.',
        'button' => 'Aktiver konto',
    ),

    'forgot' => array(
        'title' => 'Glemt passord',
        'username' => 'E-post eller brukernavn',
        'forgetit' => 'Glem det, <a href=":url">send meg tilbake</a> til påloggingssiden.',
        'button' => 'Send E-post',
        'alert' => array(
            'notactive' => 'Brukeren din er ikke aktiv! Vennligst sjekk innboksen din for aktiverings-e-posten. Sjekk også spam-mappen.',
            'alreadyasked' => 'Du har allerede bedt om en påminnelse! Vennligst sjekk innboksen din for aktiverings-e-posten. Sjekk også spam-mappen.',
            'emailfailure' => 'Noe gikk galt under forsøk på å sende deg en e-post.',
            'emailsuccess' => 'Sjekk e-posten din for tilbakestill passordkoblingen. Dobbeltklikk på spam-mappen.',
        ),
    ),

    'resend' => array(
        'title' => 'Send aktiverings e-post igjen',
        'email' => 'E-post',
        'forgetit' => 'Glem det, <a href=":url">send meg tilbake</a> til påloggingssiden.',
        'button' => 'Send E-post',
        'alert' => array(
            'usernotfound' => 'Kunne ikke finne konto knyttet til e-posten! Vær så snill, prøv på nytt.',
            'noactivations' => 'Kontoen din er allerede aktivert, eller vi kunne ikke finne noen ufullstendige aktiveringer.',
            'activationcompleted' => 'Aktivering er allerede fullført.',
            'emailfailure' => 'Noe gikk galt under forsøk på å sende deg en e-post.',
            'emailsuccess' => 'Vi har sendt deg en e-post, kontroller innboksen din. Sjekk også spam-mappen.',
        ),
    ),

    'reset' => array(
        'title' => 'Tilbakestille passord',
        'username' => 'Bekreft e-post eller brukernavn',
        'password' => 'Nytt Passord',
        'passwordagain' => 'Bekreft Nytt Passord',
        'forgetit' => 'Glem det, <a href=":url">send meg tilbake</a> til påloggingssiden.',
        'button' => 'Resett',
        'alert' => array(
            'noreminder' => 'Vi kunne ikke finne din påminnelseskode. Vær så snill, prøv på nytt.',
            'nomatch' => 'Brukernavnet samsvarer ikke med koden!',
            'cansignin' => 'Du kan nå logge inn!',
            'failure' =>'Noe gikk galt under tilbakestilling av passordet ditt. Prøv igjen senere.',
        ),
    ),


];
