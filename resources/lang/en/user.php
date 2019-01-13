<?php

return [

    'adminpanel' => 'Admin Panel',
    'profile' => 'Profile',

    'alert' => array(
        'attendancelastyear' => 'We can see that you attended last year. Want to join us for this year too? <a href=":url">Check out the seating now</a>.',
        'consentform' => 'We can see that you are under the age of 16 and at the event must have completed the consent form completed at check-in. You can find the completed form here: <a href=":url"><i class="fas fa-user-circle"></i> Consent Form</a>',
        'nobirthdate' => 'There is no birthdate assigned to your account, this is required from now on. <a href=":url">Edit your profile</a>',
    ),

    'dashboard' => array(
        'title' => 'User',
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
            'alert' => array(
                'saved' => 'Your details has been changed!',
                'failed' => 'Something went wrong when saving your details.',
                'wrongpassword' => 'Wrong password. Please try again.',
            ),
            'editprofile' => 'Edit Profile',
            'images' => 'Change Profile Images',
            'addressbook' => 'Manage Address Book',
            'password' => 'Change Password',
        ),
        'personaldata' => array(
            'title' => 'Personal Data',
        ),
        'reservations' => array(
            'title' => 'Reservations',
            'viewreservation' => 'View Reservation',
            'viewpayment' => 'View Payment',
            'reservation' => array(
                'title' => 'Reservation',
                'info' => 'Info',
                'actions' => 'Actions',
                'downloadticket' => 'Download Ticket',
                'downloadreceipt' => 'Download Receipt',
            ),
        ),
        'billing' => array(
            'title' => 'Billing',
            'payments' => array(
                'title' => 'Payments',
                'payment' => array(
                    'title' => 'Payment',
                    'downloadreceipt' => 'Download Receipt',
                ),
            ),
            'charges' => array(
                'title' => 'Charges',
            ),
        ),
        'referral' => array(
            'title' => 'Referral',
            'desc' => 'This is the referral link you can share to your friends, this will track back to you if they register at this website.',
            'users' => '{0} <em>You have not referred any users yet.</em>|{1} You have referred <strong>one</strong> user.|[2,*] You have referred <strong>:count</strong> users.',
        ),
        'changepassword' => array(
            'title' => 'Change Password',
            'alert' => array(
                'saved' => 'Your password has been changed! Please login again to confirm the password change.',
                'failed' => 'Something went wrong when saving your details.',
                'wrongpassword' => 'Your current password does not seem to match.',
            ),
            'editpassword' => 'Edit your password',
            'button' => 'Update Password',
        ),
    ),

    'profile' => array(
        'title' => 'Profile',
        'myprofile' => 'My profile',
        'attendance' => 'Attendance',
        'editprofile' => 'Edit Profile',
        'editimages' => 'Edit Images',
        'reservedaseatfor' => 'Reserved a seat for',
        'noattendance' => 'No attendance yet.',
        'alert' => array(
            'userdeleted' => 'This user has been deleted.',
        ),
        'edit' => array(
            'title' => 'Edit profile',
            'button' => 'Update Profile',

            'details' => array(
                'title' => 'Edit your profile details',
                'phonewhy' => 'Why?',
                'phonewhydesc' => 'We need your phone number in case of an emergency during the event.',
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
            'alert' => array(
                'saved' => 'Your profile cover has been changed!',
                'failed' => 'Your profile cover could not be uploaded.',
                'noimage' => 'Please select an image.',
            ),
            'button' => 'Upload Image',
            'coverphoto' => 'Cover Photo',
            'profilephoto' => 'Profile Photo',
        ),
        
    ),

    'addressbook' => array(
        'title' => 'Addressbook',
        'address' => 'Address',
        'noaddress' => 'We can\'t find any addresses tied to your account. You should <a href=":url">add</a> one.',
        'areyousure' => 'Are you sure you want to delete this address?',
        'primaryaddress' => 'I want this as my primary address',
        'confirmchanges' => 'Confirm changes with your password',
        'alert' => array(
            'nodeletewhilereservation' => 'You will not be able to delete any addresses while you have reserved seats.',
            'saved' => 'The address has now been added!',
            'updated' => 'The address has now been updated!',
            'deleted' => 'The address has now been deleted!',
            'failed' => 'Something went wrong while saving the address to the address book.',
            'wrongpassword' => 'Your current password does not seem to match.',
        ),
        'swal' => array(
            'title' => 'Nothing has been done.',
            'text' => 'The address was not deleted!',
        ),
        'create' => array(
            'title' => 'Add Address',
        ),
        'edit' => array(
            'title' => 'Edit Address',
        ),
    ),

    'gdpr' => array(
        'delete' => array(
            'title' => 'Delete Personal Data',
            'alert' => array(
                'saved' => 'Your account has now been deleted!',
            ),
            'message' => '<p>We are sorry to see you go!</p>
                    <p>When clicking the delete button your account and all its data will be deleted forever. It will not be able to recover any data attached to this account.</p>
                    <p>Make sure you <a href=":url">download your data</a> before you delete your account.</p>
                    <p>Deleting your account will anonymize your Profile and remove your name and photo from most things that your account is connected too.</p>',
            'password' => 'When you are ready to delete your account, type in your password here',
            'iamsure' => 'Yes, I am sure I want to delete my account!',
            'button' => 'Delete my account',
        ),
        'download' => array(
            'title' => 'Download Personal Data',
            'message' => 'To download all your personal data you need to confirm your password.',
        ),
        'message' => array(
            'title' => 'GDPR Agreement',
            'question' => 'Do you consent to these new changes?',
            'iconsent' => 'I Consent',
            'ideny' => 'I Deny These Changes',
            'agreement' => "<p>Probably you've heard about GDPR, but what does the regulation mean to you as a member? Here you can read about what the privacy reform implies for your member relationship on this website.</p>

                    <p><strong>What is GDPR?</strong></p>
                    <p>The EU's new privacy reform, better known as the GDPR (General Data Protection Regulation), is created to improve your data security across European land borders in EU and EEA countries. Privacy is prioritized on this website, and in this article you will find information about how we work to comply with the new Privacy Policy.</p>

                    <p><strong>A safer community for you as a member</strong></p>
                    <p>The new regulation becomes part of the Norwegian legislation, and is an additional assurance that your personal information is processed legally. There will be greater responsibility on this website for processing and securing your member data, while at the same time you will be able to conduct your online shopping in the same way as before. In other words, GDPR is only an advantage to you as a member.</p>

                    <p><strong>Your consent is ready</strong></p>
                    <p>Your current consent is still valid. What's new is that you can now choose whether you want to receive offers and news via email and that the information about your consent and what it implies is up to date.</p>
                    <p>You may withdraw your consent at any time. To get an overview or make changes to your consent, you can easily go to \"My Account\". You can also unsubscribe from emails.</p>

                    <p><strong>Coordinator and third party</strong></p>
                    <p>The chairman of this event of this is generally responsible for the event's processing of personal data. To provide a tailor-made acquisition experience for you, this website uses external partners, but your personal data is in no way neglected or sold to third parties. Here you can read more about our processing of personal data.</p>

                    <p><strong>Privacy Policy</strong></p>
                    <p>In connection with GDPR, we have adapted and simplified our privacy statement. Here you can read in detail how we process your personal information and what types of information it concerns. The declaration informs you of the customer data you provide during usage of this website and the contact points for the information internally in our system.</p>

                    <p><strong>Increased security for your customer data</strong></p>
                    <p>The new directive requires this website to have a full overview of all the event's personal data and to demand security for these. In the event of a data break, which may affect your personal information, this website follows the rules for reporting duty stated in the GDPR.</p>",
        ),
    ),

];
