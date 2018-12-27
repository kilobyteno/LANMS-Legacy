<?php

return [

    'alert' => array(
        'loggedin' => 'Welcome back!',
        'loggedout' => 'You have now been successfully been logged out!',
        'logindisabled' => 'Login and registration has been disabled at this moment. Please check back later!',
        'usernotfound' => 'User was not found.',
        'isanonymized' => 'This account has been deleted.',
        'usernotactive' => 'Your user is not active! Please check your inbox for the activation email. Check the spam-folder too.',
        'accountnotactive' => 'Account is not activated!',
        'loginfailed' => 'Could not log you in. Please try again.',
        'usernamepasswordwrong' => 'Username or password was wrong. Please try again.',
        'throttle' => 'Your IP is blocked for :delay second(s).',
        'usernametaken' => 'Username is already taken.',
        'emailtaken' => 'Email is already taken.',
        'emailfailure' => 'Something went wrong while trying to send you an email. But you user has been registered.',
        'accountcreated' => 'Your account has been created, check your email for the activation link. Double check the spam-folder.',
        'creationfailure' => 'Something went wrong while trying to register your user.',
        'activationfailure' => 'We couldn\'t find your activation code. Please try again.',
        'usernameactivationfailure' => 'Username and activation code does not match.',
        'accountactivated' => 'Your account has been activated!',
        'accountactivationfailure' => 'Something went wrong while activating your account. Please try again later.',
    ),

    'signout' => 'Sign out',

    'signin' => array(
        'title' => 'Sign in to your Account',
        'username' => 'Email or username',
        'rememberme' => 'Remember me',
        'forgot' => 'I forgot my password',
        'resend' => 'Resend activation email',
        'button' => 'Sign in',
    ),

    'signup' => array(
        'title' => 'Create New Account',
        'dateofbirth' => 'Date of Birth',
        'agreement' => 'I have read and agree to the<br><strong>Terms of Service and Privacy Policy</strong>',
        'button' => 'Sign up',
        'button_alt' => 'Create new account',
        'haveaccount' => 'Already have account?',
    ),

    'activate' => array(
        'title' => 'Activate Account',
        'username' => 'Confirm email or username',
        'forgetit' => 'Forget it, <a href=":url">send me back</a> to the sign in page.',
        'button' => 'Activate account',
    ),

    'forgot' => array(
        'title' => 'Forgot Password',
        'username' => 'Email or username',
        'forgetit' => 'Forget it, <a href=":url">send me back</a> to the sign in page.',
        'button' => 'Send Email',
    ),

    'resend' => array(
        'title' => 'Resend Verification',
        'email' => 'Email',
        'forgetit' => 'Forget it, <a href=":url">send me back</a> to the sign in page.',
        'button' => 'Send Email',
    ),

    'reset' => array(
        'title' => 'Reset Password',
        'username' => 'Confirm email or username',
        'password' => 'New Password',
        'passwordagain' => 'Confirm New Password',
        'forgetit' => 'Forget it, <a href=":url">send me back</a> to the sign in page.',
        'button' => 'Reset',
    ),


];
