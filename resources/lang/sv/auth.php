<?php

return [

    'alert' => array(
        'loggedin' => 'Välkommen tillbaka!',
        'loggedout' => 'Du är nu utloggad!',
        'logindisabled' => 'Inloggning och registrering av nya konton är inte tillgängligt. Kom tillbaka vid ett senare tillfälle.',
        'usernotfound' => 'Användaren finns inte!',
        'isanonymized' => 'Detta konto har blivit borttaget.',
        'usernotactive' => 'Ditt användarkonto är inte aktiverat. Kolla din email för intruktioner (Ibland hamnar vi i skräpposten, kolla även där).',
        'accountnotactive' => 'Kontot är inte aktiverat.',
        'loginfailed' => 'Det gick inte att logga in dig. Prova igen!',
        'usernamepasswordwrong' => 'Användarnamn eller lösenord blev fel. Prova igen!s',
        'throttle' => 'Din IP är blockerad i :delay sekund(er).',
        'usernametaken' => 'Användernamnet är upptaget.',
        'emailtaken' => 'Den e-postadress du angett används redan.',
        'emailfailure' => 'Något gick fel när vi skulle skicka e-post till dig. Vi har registrerat din användare ändå.',
        'accountcreated' => 'Ditt konto har blivit skapat, kolla din e-post för aktiveringslänken. Kolla även i skräpposten.',
        'creationfailure' => 'Något gick fel när vi skulle registrera ditt konto.',
        'activationfailure' => 'Vi kunde inte hitta din aktiveringskod. Blev det fel? Försök igen!',
        'usernameactivationfailure' => 'Användarnamn och aktiveringskod matchar inte.',
        'accountactivated' => 'Ditt konto har blivit aktiverat!',
        'accountactivationfailure' => 'Något gick fel när vi skulle aktivera ditt konto. Försök igen!',
        'resetpassword' => 'Du har återställt ditt lösenord, se din e-post för instruktioner.',
    ),

    'signout' => 'Logga ut',

    'signin' => array(
        'title' => 'Logga in på ditt konto',
        'username' => 'E-post eller användarnamn',
        'rememberme' => 'Kom ihåg mig',
        'forgot' => 'Glömt lösenord?',
        'resend' => 'Skicka nytt aktiveringsmail',
        'button' => 'Logga in',
    ),

    'signup' => array(
        'title' => 'Skapa nytt konto',
        'dateofbirth' => 'Födelsedatum',
        'agreement' => 'Jag har läst och godkänner <br><strong>användarvillkoren och integritetspolicyn.</strong>',
        'button' => 'Registrera',
        'button_alt' => 'Skapa nytt konto',
        'haveaccount' => 'Det ser ut som att du redan har ett konto hos oss.',
    ),

    'activate' => array(
        'title' => 'Aktivera konto',
        'username' => 'Bekräfta e-post eller användarnamn',
        'forgetit' => 'Jag ångra mig, <a href=":url">ta mig tillbaka</a> till inloggningen.',
        'button' => 'Aktivera konto',
    ),

    'forgot' => array(
        'title' => 'Glömt lösenord',
        'username' => 'E-post eller användarnamn',
        'forgetit' => 'Jag ångra mig, <a href=":url">ta mig tillbaka</a> till inloggningen.',
        'button' => 'Skicka e-post',
        'alert' => array(
            'notactive' => 'Your user is not active! Please check your inbox for the activation email. Check the spam-folder too.',
            'alreadyasked' => 'You have already asked for a reminder! Please check your inbox for the activation email. Check the spam-folder too.',
            'emailfailure' => 'Something went wrong while trying to send you an email.',
            'emailsuccess' => 'Check your email for the reset password link. Double check the spam-folder.',
        ),
    ),

    'resend' => array(
        'title' => 'Skicka aktiveringslänken igen!',
        'email' => 'E-post',
        'forgetit' => 'Jag ångra mig, <a href=":url">ta mig tillbaka</a> till inloggningen.',
        'button' => 'Skicka e-post',
        'alert' => array(
            'usernotfound' => 'Användarnamnet eller e-posten stämmer inte! Försök igen.',
            'noactivations' => 'Ditt konto är redan aktiverat!.',
            'activationcompleted' => 'Aktiveringen är redan slutförd!',
            'emailfailure' => 'Något gick fel.',
            'emailsuccess' => 'Vi har skickat ett nytt e-post meddelande, kolla din inkorg. Titta även i skräpposten.',
        ),
    ),

    'reset' => array(
        'title' => 'Glömt lösenord?',
        'username' => 'E-post eller användarnamn',
        'password' => 'Nytt lösenord',
        'passwordagain' => 'Bekräfta nytt lösenord',
        'forgetit' => 'Jag ångra mig, <a href=":url">ta mig tillbaka</a> till inloggningen.',
        'button' => 'Återställ!',
        'alert' => array(
            'noreminder' => 'Din kod är fel. Testa igen.',
            'nomatch' => 'Användaren och koden stämmer inte överrens!',
            'cansignin' => 'Du kan nu logga in!',
            'failure' =>'Något gick fel när vi skulle återställa ditt lösenord. Försök igen senare eller kontakta oss.',
        ),
    ),


];
