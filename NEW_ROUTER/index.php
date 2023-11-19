<?php
$req_uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$req_uri = substr($req_uri, -1) == '/' ? substr_replace($req_uri, "", -1) : $req_uri;

//REQUETS PARAMETERS
// $_REQUEST


switch ($req_uri) {
    case '/':
    case '/home':
        require_once "./views/home.php";
        break;

    case '/post':
        require_once "./views/post.php";
        break;

    case '/user':
        require_once "./views/user.php";
        break;

    case '/about':
        require_once "./views/about.php";
        break;

    case '/version':
        require_once "./views/version.php";
        break;

    case '/resetpass':
        require_once "./views/resetpass.php";
        break;

    default:
        require_once "./views/404.php";
        break;
}
?>

<h3>URLS</h3>
<pre>
    <? print_r(parse_url($_SERVER['REQUEST_URI'])) ?>
</pre>