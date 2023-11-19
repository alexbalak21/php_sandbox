<?php

$url = "/home/123";

$url = substr($url, -1) == '/' ? substr_replace($url, "", -1) : $url;

echo $url;
