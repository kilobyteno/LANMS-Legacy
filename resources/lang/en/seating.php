<?php

return [

    'alert' => array(
        'noaddress' => ' It seems like you do not have any addresses attached to your account. You will not be able to reserve any seat before you have added one primary address. You should <a href=":url" class="alert-link">add</a> one.',
        'closed' => 'Seating is closed at this moment, you cannot reserve seats or change reservations.',
    ),

    'closed' => 'Seatmap is not available at this moment!',
    'checklater' => 'Please check back later...',

    'map' => array(
        'scene' => 'Scene',
        'exit' => 'Exit',
        'kiosk' => 'Kiosk',
        'available' => 'Available',
        'you' => 'This seat is reserved for you!',
        'reservedfor' => 'Reserved for',
        'tempreserved' => 'Temporary Reserved By',
    ),

    'reservation' => array(
        'none' => 'You haven\'t reserved any seats...',
        'your' => 'Your Reservations',
        'foryou' => 'Seat reserved for you',
        'expires' => 'Expires',
        'paid' => 'Paid',
        'notpaidyet' => 'Not paid yet',
        'notpaidyetdesc' => 'Pay at the entrance',
        'notpaid' => 'Unpaid',
        'view' => 'View',
        'pay' => 'Pay now',
        'changepayment' => 'Change payment',
        'ticket' => 'Download Ticket',
        'remove' => 'Remove reservation',
        'consentform' => array(
            'title' => 'Consent Form',
            'desc' => 'Personen som denne reservasjonen er reservert for er under 16 år og må ha med samtykkeskjema, ferdig utfyllt ved innskjekking på arrangementet.',
            'why' => 'Hvorfor ser jeg denne?',
        ),
        'pizza' => array(
            'title' => 'Pizza',
            'desc' => 'You get a pizza at the event!',
        ),
    ),

    'show' => array(
        'seat' => 'Seat',
        'reserved' => 'This seat is :type for this member.',
        'reservedfor' => 'Reserved for',
        'agreement' => 'I have read and agree to the <strong>Terms of Service</strong> and the <strong>Rules</strong> of this event.',
        'button' => 'Reserved Seat',
        'alert' => array(
            'cannotbereserved' => 'This seat cannot be reserved!',
            'reservationlimit' => 'You are not allowed to reserve more than <em>five</em> seats.',
            'closed' => 'Seating is closed at this moment, you cannot reserve seats or change reservations.',
        ),
    ),

    'pay' => array(
        'title' => 'Pay for Reservation',
        'price' => 'Price',
        'entrancebutton' => 'Pay at the entrance*',
        'entrancedesc' => '* Additional fee (:price) and <a href=":url">Terms</a> apply',
        'or' => 'or',
        'button' => 'Pay Now',
        'processing' => 'Processing Payment',
        'card' => array(
            'number' => 'CARD NUMBER',
            'expmonth' => 'EXP. MONTH',
            'expyear' => 'EXP. YEAR',
            'cvc' => 'CVC',
            'name' => 'NAME ON CARD',
        ),
    ),

];
