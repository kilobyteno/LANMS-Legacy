<?php

return [

    'adminpanel' => 'Admin Panel',
    'profile' => 'Profile',

    'alert' => array(
        'attendancelastyear' => 'We can see that you attended last year. Want to join us for this year too? <a href=":url">Check out the seating now</a>.',
        'consentform' => 'We can see that you are under the age of 15 and at the event must have completed the consent form completed at check-in. You can find the completed form here: <a href=":url"><i class="fas fa-user-circle"></i> Consent Form</a>',
        'nobirthdate' => 'There is no birthdate saved to your account. We need this to confirm your identity. <a href=":url">Edit your profile</a>',
        'nophone' => 'There is no phone number saved to your account. We need your phone number in case of an emergency during the event. <a href=":url">Edit your profile</a>',
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
        'identity' => 'Show my identity',
        'details' => array(
            'title' => 'Details',
            'alert' => array(
                'saved' => 'Your details has been changed!',
                'failed' => 'Something went wrong when saving your details.',
                'wrongpassword' => 'Wrong password. Please try again.',
            ),
            'editprofile' => 'Edit Profile',
            'images' => 'Change Profile Images',
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
            'alert' => array(
                'noaddress' => 'It seems like there is no address attached to this account. It will not be possible to pay for invoices before there is a address on this account. You can <a href=":url" class="alert-link">add one here</a>.',
            ),
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
            'invoice' => array(
                'title' => 'Invoice',
                'invoiceto' => 'Invoice To',
                'status' => array(
                    'draft' => 'Draft',
                    'open' => 'Open',
                    'paid' => 'Paid',
                    'void' => 'Void',
                    'uncollectible' => 'Uncollectible',
                    'scheduled' => 'Scheduled',
                ),
                'event' => array(
                    'invoice' => array(
                        'created' => 'The draft invoice was created.',
                        'updated' => 'Invoice was updated.',
                        'finalized' => 'The draft invoice was finalized.',
                        'sent' => 'Invoice was sent.',
                        'marked_uncollectible' => 'Invoice was marked uncollectible.',
                        'voided' => 'Invoice was voided.',
                        'payment_failed' => 'Payment failed.',
                        'payment_succeeded' => 'Payment succeeded.',
                    ),
                ),
                'product' => 'Product',
                'quantity' => 'Quantity',
                'unitprice' => 'Unit Price',
                'amount' => 'Amount',
                'subtotal' => 'Sub Total',
                'discount' => 'Discount',
                'taxrate' => 'Tax Rate',
                'taxdue' => 'Tax Due',
                'totaldue' => 'Total Due',
                'amountpaid' => 'Amount Paid',
                'amountremaining' => 'Amount Remaining',
                'payinvoice' => 'Pay Invoice',
                'printinvoice' => 'Print Invoice',
                'explination' => 'We will charge the <a href=":url" class="alert-link">default card</a> added to your account to take care of this payment.',
                'alert' => array(
                    'paid' => 'This invoice has now been paid.',
                    'nocards' => 'There are no cards attached to your account. You can add one <a href=":url" class="alert-link">here</a>.',
                    'scheduled' => 'This draft invoice can be edited until it\'s automatically finalized :time.'
                ),
            ),
            'card' => array(
                'title' => 'Credit Cards',
                'alert' => array(
                    'deleted' => 'The card has now been deleted.',
                    'added' => 'The card has now been added.',
                ),
                'create' => array(
                    'title' => 'Add Card',
                ),
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
        'verifyphone' => array(
            'title' => 'Verify Phone',
            'alert' => array(
                'saved' => 'Phonenumber was successfully verified.',
                'failed' => 'Verification failed!',
                'nophone' => 'No phonenumber saved.',
                'alreadyverified' => 'Phone has already been verified.',
                'info' => 'Verification token has been sent! Please wait up to one minute. ',
            ),
            'typecode' => 'Type in the code you received on a SMS',
            'button' => 'Verify',
        ),
    ),

    'profile' => array(
        'title' => 'Profile',
        'myprofile' => 'My profile',
        'editprofile' => 'Edit Profile',
        'editimages' => 'Edit Images',
        'noattendance' => 'No attendance yet.',
        'alert' => array(
            'userdeleted' => 'This user has been deleted.',
        ),
        'activity' => array(
            'title' => 'Activity',
            'reservedaseatfor' => '<strong>:Name</strong> reserved a seat for',
        ),
        'edit' => array(
            'title' => 'Edit profile',
            'button' => 'Update Profile',

            'details' => array(
                'title' => 'Edit your profile details',
                'phonewhy' => 'Why?',
                'phonewhydesc' => 'We need your phone number in case of an emergency during the event.',
            ),

            'address' => array(
                'title' => 'Edit your address',
            ),

            'settings' => array(
                'title' => 'Edit your settings',
                'show' => 'Show',
                'fullname' => 'Fullname',
                'onlinestatus' => 'Online Status',
                'language' => 'Preferred Language',
                'theme' => 'Preferred Theme',
                '2fa' => array(
                    'title' => 'Two Factor Authentication',
                    'desc' => 'Please enter the OTP sent to your phone number',
                    'disabled' => 'You need to verify your phone number before you can activate 2FA!',
                    'info' => 'We use Authy for 2FA and we highly recommend you to use the <a class="alert-link" href=":url">Authy app</a>.',
                    'alert' => array(
                        'activated' => 'Two-factor authentication is now enabled!',
                        'deactivated' => 'Two-factor authentication is disabled!',
                        'missingenv' => 'Two-factor authentication is not activated by the administrator!',
                    ),
                ),
            ),

            'confirmpassword' => array(
                'title' => 'Confirm changes with your password',
            ),

        ),

        'changeimages' => array(
            'title' => 'Change Profile Images',
            'alert' => array(
                'saved' => 'Your image has been uploaded!',
                'failed' => 'Your image could not be uploaded.',
                'noimage' => 'Please select an image.',
            ),
            'button' => 'Upload Image',
            'coverphoto' => 'Cover Photo',
            'profilephoto' => 'Profile Photo',
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
                    <p>Deleting your account will anonymize your Profile and remove your name and photo from most things that your account is connected to.</p>',
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
            'alert' => array(
                'saved' => 'Your choice has been saved.',
                'denied' => 'You have to accept the new agreement to use this service. This is because of the new GDPR rules.',
            ),
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
