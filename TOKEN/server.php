<?php
$headers = getallheaders();
foreach ($headers as $key => $value) {
    echo "$key  :  $value <br>";
}
