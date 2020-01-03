<?php

return [

    'home' => array(
        'info' => 'Info',
        'where' => 'Where',
        'when' => 'When',
        'price' => 'Price',
    ),

    'members' => array(
        'search' => array(
            'title' => 'Search Members',
            'placeholder' => 'Username or Name',
            'button' => 'Search',
            'results' => 'results', //lowercase
        ),
        'newest' => array(
            'title' => 'Newest Members',
        ),
        'lastonline' => array(
            'title' => 'Last Online Members',
        ),
        'table' => array(
            'username' => 'Username',
            'name' => 'Name',
            'joined' => 'Joined',
            'lastseen' => 'Last Seen',
            'showing' => 'Showing :pluck of :total total members',
        ),
    ),

    'errors' => array(
        'button' => 'Back To Home',
        'default' => array(
            'title' => 'Unknown',
            'desc' => 'Something unknown happend.',
        ),
        '401' => array(
            'title' => 'Unauthorized',
            'desc' => 'Authentication is required and has failed or has not yet been provided.',
        ),
        '403' => array(
            'title' => 'Forbidden',
            'desc' => 'Sorry, you are forbidden from accessing this page.',
        ),
        '404' => array(
            'title' => 'Page Not Found',
            'desc' => 'Seems like this page does not exist.',
        ),
        '500' => array(
            'title' => 'Server Error',
            'desc' => 'Looks like we\'re having some server issues.',
        ),
    ),

    'tickets' => array(
        'free' => 'Free',
    ),

];
