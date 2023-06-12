<?php

return [

    'alert' => array(
        'loggedin' => 'Välkommen tillbaka!',
        'loggedout' => 'Du har nu loggats ut!',
        'logindisabled' => 'Inloggning och registrering är för närvarande avstängd. Vänligen försök igen senare!',
        'usernotfound' => 'Användaren kunde inte hittas.',
        'isanonymized' => 'Det här kontot har tagits bort.',
        'usernotactive' => 'Din användare är inte aktiv! Vänligen kontrollera din inkorg för aktiveringsmailet. Kolla även i skräpposten.',
        'accountnotactive' => 'Kontot är inte aktiverat!',
        'loginfailed' => 'Kunde inte logga in. Vänligen försök igen.',
        'usernamepasswordwrong' => 'Användarnamn eller lösenord var felaktigt. Vänligen försök igen.',
        'throttle' => 'Din IP-adress är blockerad i :delay sekund(er).',
        'usernametaken' => 'Användarnamnet är redan upptaget.',
        'emailtaken' => 'E-postadressen är redan upptagen.',
        'emailfailure' => 'Något gick fel när vi försökte skicka mail till dig. Men ditt konto har registrerats.',
        'accountcreated' => 'Ditt konto har skapats, kontrollera din e-post för aktiveringslänken. Dubbelkolla skräpposten.',
        'creationfailure' => 'Något gick fel när vi försökte registrera din användare.',
        'activationfailure' => 'Vi kunde inte hitta din aktiveringskod. Vänligen försök igen.',
        'usernameactivationfailure' => 'Användarnamn och aktiveringskod matchar inte.',
        'accountactivated' => 'Ditt konto har aktiverats!',
        'accountactivationfailure' => 'Något gick fel när vi aktiverade ditt konto. Vänligen försök igen senare.',
        'resetpassword' => 'Du har återställt ditt lösenord, vänligen kontrollera din e-post.',
    ),

    'signout' => 'Logga ut',

    'signin' => array(
        'title' => 'Logga in på ditt konto',
        'username' => 'E-post eller användarnamn',
        'rememberme' => 'Kom ihåg mig',
        'forgot' => 'Jag har glömt mitt lösenord',
        'resend' => 'Skicka aktiveringsmail igen',
        'button' => 'Logga in',
    ),

    'signup' => array(
        'title' => 'Skapa nytt konto',
        'dateofbirth' => 'Födelsedatum',
        'agreement' => 'Jag har läst och godkänner<br><strong>Användarvillkoren och integritetspolicyn</strong>',
        'button' => 'Skapa konto',
        'button_alt' => 'Skapa nytt konto',
        'haveaccount' => 'Har du redan ett konto?',
    ),

    'activate' => array(
        'title' => 'Aktivera konto',
        'username' => 'Bekräfta e-post eller användarnamn',
        'forgetit' => 'Glöm det, <a href=":url">skicka tillbaka mig</a> till inloggningssidan.',
        'button' => 'Aktivera konto',
    ),

    'forgot' => array(
        'title' => 'Glömt lösenord',
        'username' => 'E-post eller användarnamn',
        'forgetit' => 'Glöm det, <a href=":url">skicka tillbaka mig</a> till inloggningssidan.',
        'button' => 'Skicka mail',
        'alert' => array(
            'notactive' => 'Din användare är inte aktiverad! Vänligen kontrollera din inkorg för aktiveringsmailet. Kolla även i skräpposten.',
            'alreadyasked' => 'Du har redan begärt en ny aktivering! Vänligen kontrollera din inkorg för aktiveringsmailet. Kolla även i skräpposten.',
            'emailfailure' => 'Något gick fel när vi försökte skicka mail till dig.',
            'emailsuccess' => 'Kontrollera din e-post för återställningslänken för lösenordet. Kolla även skräpposten.',
        ),
    ),

    'resend' => array(
        'title' => 'Skicka aktiveringsmail igen',
        'email' => 'E-post',
        'forgetit' => 'Glöm det, <a href=":url">skicka tillbaka mig</a> till inloggningssidan.',
        'button' => 'Skicka mail',
        'alert' => array(
            'usernotfound' => 'Kunde inte hitta ett konto kopplat till e-postadressen! Vänligen försök igen.',
            'noactivations' => 'Ditt konto är redan aktiverat eller så kunde vi inte hitta några ofullständiga aktiveringar.',
            'activationcompleted' => 'Aktiveringen har redan slutförts.',
            'emailfailure' => 'Något gick fel när vi försökte skicka dig ett mail.',
            'emailsuccess' => 'Vi har skickat ett mail till dig, kontrollera din inkorg. Kolla även i skräpposten.',
        ),
    ),

    'reset' => array(
        'title' => 'Återställ lösenord',
        'username' => 'Bekräfta e-post eller användarnamn',
        'password' => 'Nytt lösenord',
        'passwordagain' => 'Bekräfta nytt lösenord',
        'forgetit' => 'Glöm det, <a href=":url">skicka tillbaka mig</a> till inloggningssidan.',
        'button' => 'Återställ',
        'alert' => array(
            'noreminder' => 'Vi kunde inte hitta din kod. Vänligen försök igen.',
            'nomatch' => 'Användarnamnet matchar inte koden!',
            'cansignin' => 'Du kan nu logga in!',
            'failure' =>'Något gick fel när vi återställde ditt lösenord. Vänligen försök igen senare.',
        ),
    ),
];
