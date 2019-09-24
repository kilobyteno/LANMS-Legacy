<?php

return [

    'youreceived' => 'You received this email because you registered on:',

    'hello' => 'Hello :firstname!',

    'auth' => array(

        'activate' => array(
            'title' => 'Activate your account',
            'hello' => 'Hello :firstname! To activate your account, click on the following link:'
        ),
        'forgotpassword' => array(
            'title' => 'Forgot Password',
            'desc' => 'It looks as if you have requested to reset your password. Use the link below to create a new password for your account. If you did not expect this email, you can safely ignore it.',
            'url' => 'Reset Password URL',
            'questions' => 'If you have any questions at all, feel free to contact us!',
        ),

    ),

    'seat' => array(

        'removed' => array(
            'title' => 'Reservation removed!',
            'desc' => 'Your reservation for the :seatname seat has been removed, since you have not paid for it within 48 hours of reservation time.'
        ),
        'removedsoon' => array(
            'title' => 'Your reservation will be removed soon!',
            'desc' => 'Your reservation for the :seatname seat will be removed in 24 hours, if you do not pay for the seat.',
        ),


    ),

];
