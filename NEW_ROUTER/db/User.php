<?php
$users = [
    [
        "email" => "alex@mail.com",
        "password" => "Azerty123*",
    ], [
        "email" => "max@mail.com",
        "password" => "Poiuy789!",
    ]
];
class User
{
    private $users = [
        [
            "email" => "alex@mail.com",
            "password" => "Azerty123*",
        ], [
            "email" => "max@mail.com",
            "password" => "Poiuy789!",
        ]
    ];
    static function email_in_db($email)
    {
        foreach (self::$users as $user) {
            if ($user['email'] == $email) {
                return true;
            }
        }
        return false;
    }
}
