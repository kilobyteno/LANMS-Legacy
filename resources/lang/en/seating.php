<?php

return [

    'alert' => array(
        'noaddress' => 'It seems like you do not have any addresses attached to your account. You will not be able to reserve any seat before you have added one primary address. You should <a href=":url" class="alert-link">add</a> one.',
        'closed' => 'Seating is closed at this moment, you cannot reserve seats or change reservations.',
        'seatnotfound' => 'Could not find seat.',
        'seatingclosed' => 'It is not possible to reserve seats at this time.',
        'paymentexist' => 'This seat already has a payment assigned to it.',
        'youcantpay' => 'You can\'t pay for this seat.',
        'noreservation' => 'There was no reservation found for this seat.',
        'carderror' => 'Please check your card information and try again',
        'pleasetryagain' => 'Please try again.',
        'seatpaid' => ':seatname is now reserved and paid for! We are exited to have you, welcome!',
        'seattemppaid' => ':seatname is now marked as pay at entrance! We are exited to have you, welcome!',
        'paymentcantchange' => 'You can\'t change your payment of your reservation after the first 48 hours.',
        'youcanchangepayment' => 'You can now change your payment of your reservation.',
        'notpossibleonthisrow' => 'It is not possible to reserve seats on this row.',
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
            'desc' => 'The person who has this reservation is reserved for under 16 years and must have a consent form, completed upon check-in at the event.',
            'why' => 'Why do I see this?',
        ),
        'pizza' => array(
            'title' => 'Pizza',
            'desc' => 'You get a pizza at the event!',
        ),
        'alert' => array(
            'notpossibleonthisrow' => 'It is not possible to reserve seats on this row.',
            'alreadyreserved' => 'Seat has already been reserved.',
            'nobirthday' => 'You need to have an birthdate assigned to your account to be able to reserve a seat.',
            'noaddresses' => 'It seems like you do not have any addresses attached to your account. You will not be able to reserve any seat before you have added one primary address.',
            'limit' => 'You have reached the reservation limit. So you are not allowed to reserve more seats.',
            'limitself' => 'You cannot reserve more than one seat to yourself. Please select another member you want to reserve this seat for.',
            'nobirthdayfor' => 'It seems like :name does not have an birthdate assigned to their account, they need it to be able to reserve a seat.',
            'noaddressesfor' => 'It seems like :name does not have any addresses attached to their account. They will not be able to reserve any seat before they have added one primary address.',
            'limitreservedfor' => ':name are not allowed to reserve more seats.',
            'alreadyreservedfor' => ':name has already reserved a seat.',
            'success' => 'You have successfully reserved this seat!',
            'failure' => 'Something went wrong while saving the reservation!',
            'ticketnoaccess' => 'You are not allowed to view this ticket.',
            'destroy' => array(
                'notfound' => 'Could not find reservation.',
                'noaccess' => 'You can\'t remove this reservation.',
                'cantberemovedafter' => 'You can\'t remove reservation after the first :hours hours.',
                'cantberemoved' => 'You can\'t remove this reservation after it is reserved.',
                'success' => 'The reservation has now been removed!',
                'failure' => 'Something went wrong while deleting the reservation.',
            ),
        ),
    ),

    'show' => array(
        'seat' => 'Seat',
        'reserved' => 'This seat is :type for this member.',
        'reservedfor' => 'Reserved for',
        'agreement' => 'I have read and agree to the <strong>Purchase Conditions</strong> and the <strong>Rules</strong> of this event.',
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