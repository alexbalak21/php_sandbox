<?php
ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

session_set_cookie_params(["lifetime" => 1800, "domain" => "127.0.0.1", "path" => '/', "httponly" => true]);
session_set_cookie_params(["secure" => true]);

session_start();

if (!isset($_SESSION['last_regeneration'])) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
} else {
    $lifeTime = 60 * 30;
    if (time() - $_SESSION['last_regeneration'] >= $lifeTime) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}
