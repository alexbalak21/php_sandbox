<?php
session_start();
$lifeTime = 30 * 60;
if (isset($_SESSION['last_regeneration'])) {
    if (time() - $_SESSION['last_regeneration'] > $lifeTime)
        session_destroy();
} else session_destroy();
