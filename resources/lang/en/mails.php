<?php

return [

    'notification' => [
        'greeting' => [
            'default' => 'Greetings !',
            'named' => 'Dear :name,',
            'error' => 'Whoops !',
        ],
        'action' => [
            'alternative' => 'If you are unable to click on the « :actionText », copy/paste the link below into your browser: :actionURL',
            'contact' => 'Contact us',
            'phone' => '[:phoneNumber](tel::phoneNumber)',
            'email' => '[:email](mailto::email)',
        ],
        'salutation' => [
            'default' => 'Regards',
        ],
        'signature' => 'The team **:team**',
        'noReply' => 'This email has been sent automatically. Thank you for not answering it.',
    ],

    'passwordReset' => [
        'subject' => 'Reset your password',
        'message' => 'This email has been sent to you because we have received a password reset request for your account.',
        'action' => 'Reset password',
        'notice' => 'If you have not requested a password reset, no action is required.',
    ],

    'emailVerification' => [
        'subject' => 'Confirm your email address',
        'message' => 'To confirm your email address, please click the button below.',
        'action' => 'Confirm my email address',
        'notice' => 'If you have not created an account, no action is required.',
    ],

    'ContactFormMessage' => [
        'subject' => [
            'original' => 'Contact form : new message',
            'copy' => 'Contact form : copy of your message',
        ],
        'message' => [
            'original' => 'This message has been sent from the contact form of :app.',
            'copy' => 'This is a copy of the message your sent from the contact form of :app.',
        ],
    ],

];
