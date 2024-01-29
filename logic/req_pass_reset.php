<?php

$reset_pass_utl = [];



require_once "./db/User.php";
function send_reset_password_link(string $mail)
{
    $present = User::email_in_db("alex@mail.com");
    if (!$present) {
        return "";
    }
}

function register_reset_pass_url($key)
{
}
