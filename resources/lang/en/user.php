<?php

return [

    'adminpanel' => 'Admin Panel',
    'profile' => 'Profile',

    'loggedin' => 'Welcome back!',
    'loggedout' => 'You have now been successfully been logged out!',

    'alert' => array(
        'attendancelastyear' => 'We can see that you attended last year. Want to join us for this year too? <a href=":url">Check out the seating now</a>.',
        'consentform' => 'Vi kan se at du er under 16 år og på arrangementet må ha med samtykkeskjema ferdig utfyllt ved innskjekking. Ferdig generert skjema finner du her: <a href=":url"><i class="fa fa-user-circle-o"></i> Samtykkeskjema</a>',
        'nobirthdate' => 'There is no birthdate assigned to your account, this is required from now on. <a href=":url">Edit your profile</a>',
    ),

    'dashboard' => array(
        'title' => 'User Dashboard',
        'quicklinks' => array(
            'title' => 'Quick Links',
            'youraccount' => 'Your Account',
            'yourprofile' => 'Your Profile',
            'changepassword' => 'Change Password',
        ),
    ),

    'account' => array(
        'title' => 'Account',
        'details' => array(
            'title' => 'Details',
            'editprofile' => 'Edit Profile',
            'images' => 'Change Profile Images',
            'addressbook' => 'Manage Address Book',
            'password' => 'Change Password',
        ),
        'personaldata' => array(
            'title' => 'Personal Data',
            'download' => 'Download',
            'delete' => 'Delete',
        ),
        'reservations' => array(
            'title' => 'Reservations',
        ),
        'billing' => array(
            'title' => 'Billing',
            'payments' => 'Payments',
            'charges' => 'Charges',
        ),
        'referral' => array(
            'title' => 'Referral',
            'desc' => 'This is the referral link you can share to your friends, this will track back to you if they register at this website.',
            'users' => '{0} <em>You have not referred any users yet.</em>|{1} You have referred <strong>:count</strong> user.|[2,*] You have referred <strong>:count</strong> users.',
        ),
        'changepassword' => array(
            'title' => 'Change Password',
            'editpassword' => 'Edit your password',
            'button' => 'Update Password',
        ),
    ),

    'profile' => array(
        'title' => 'Profile',
        'myprofile' => 'My profile',
        'edit' => array(
            'title' => 'Edit profile',
            'button' => 'Update Profile',

            'details' => array(
                'title' => 'Edit your profile details',
            ),

            'settings' => array(
                'title' => 'Edit your settings',
                'show' => 'Show',
                'fullname' => 'Fullname',
                'onlinestatus' => 'Online Status',
                'dateformat' => 'Date format',
                'timeformat' => 'Time format',
            ),

            'confirmpassword' => array(
                'title' => 'Confirm changes with your password',
            ),

        ),

        'changeimages' => array(
            'title' => 'Change Profile Images',
            'button' => 'Upload Image',
            'coverphoto' => 'Cover Photo',
            'profilephoto' => 'Profile Photo',
        ),
        
    ),

];
