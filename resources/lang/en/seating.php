<?php

return [

    'alert' => array(
        'noaddress' => 'It seems like you do not have a address attached to your account. You will not be able to reserve any seat before you have added a address. You should <a href=":url" class="alert-link">add</a> one.',
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
        'unpaidinvoice' => 'You have one or more unpaid invoices, please pay these first. You will be able to reserve a seat once this has been taken care of.',
        'tickets' => 'For more information about the different ticket types, visit <a href=":url">this page</a>.',
        'entrancepaymentnotallowed' => 'This ticket cannot be paid at the entrance. Pay by card instead.',
    ),

    'closed' => 'Seatmap is not available at this moment!',
    'checklater' => 'Please check back later...',

    'map' => array(
        'scene' => 'Scene',
        'exit' => 'Exit',
        'kiosk' => 'Kiosk',
        'available' => 'Available',
        'unavailable' => 'Unavailable',
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
        'view' => 'View seat',
        'pay' => 'Pay now',
        'changepayment' => 'Change payment',
        'download' => 'Download PDF ticket',
        'ticket' => 'Show digital ticket',
        'remove' => 'Remove reservation',
        'consentform' => array(
            'title' => 'Consent Form',
            'desc' => 'The person who has this reservation is reserved for under 15 years and must have a consent form, completed upon check-in at the event.',
            'why' => 'Why do I see this?',
        ),
        'pizza' => array(
            'title' => 'Pizza',
            'desc' => 'You get a pizza at the event!',
        ),
        'alert' => array(
            'notpossibleonthisrow' => 'It is not possible to reserve seats on this row.',
            'alreadyreserved' => 'Seat has already been reserved.',
            'youcannotpay' => 'You cannot pay for this reservation, the person who reserved it has to do it.',
            'nobirthday' => 'You need to have an birthdate assigned to your account to be able to reserve a seat.',
            'noaddress' => 'It seems like you do not have a address attached to your account.',
            'limit' => 'You have reached the reservation limit. So you are not allowed to reserve more seats.',
            'limitself' => 'You cannot reserve more than one seat to yourself. Please select another member you want to reserve this seat for.',
            'nobirthdayfor' => 'It seems like :name does not have an birthdate assigned to their account, they need it to be able to reserve a seat.',
            'noaddressfor' => 'It seems like :name does not have a address attached to their account. They will not be able to reserve any seat before they have added a address.',
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
        'tickettype' => 'Ticket Type',
        'entrancebutton' => 'Pay at the entrance*',
        'entrancedesc' => '* <strong>Purchase Conditions</strong> apply',
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

    'ticket' => array(
        'title' => 'Digital Ticket',
        'checkin' => array(
            'title' => 'Your checkin code',
        ),
    ),

    'checkin' => array(
        'title' => 'Self check-in',
        'subtitle' => 'Enter your check-in code here',
        'info' => 'You need to your phone verified, be 15 years or older and paid for your ticket to use this check-in.',
        'alert' => array(
            'success' => 'Success! Please see your nearest crew for your band.',
            'notfound' => 'Not found.',
            'notallowed' => 'You are not allowed to self check-in, either you are too young, not have verified your phone or you have not paid.',
            'failed' => 'Self check-in failed.',
        ),
    ),

];
