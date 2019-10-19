<?php

return [

    'global' => array(
        'hello' => 'Hello!',
        'whoops' => 'Whoops!',
        'regards' => 'Regards',
        'trouble' => 'If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n into your web browser: [:actionURL](:actionURL)',
        'youreceived' => 'You received this email because you are registered on:',
        'copyright' => 'All rights reserved.',
    ),

    'reservation' => array(
        'expired' => array(
            'title' => 'Reservation removed!',
            'desc' => 'Your reservation for the :seatname seat has been removed, since you have not paid for it within   reservation time.'
        ),
        'expires' => array(
            'title' => 'Your reservation will be removed soon!',
            'desc' => 'Your reservation for the :seatname seat will be removed in 24 hours, if you do not pay for the reservation.',
        ),
    ),
];
