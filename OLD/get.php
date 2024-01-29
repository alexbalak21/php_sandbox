<?php
function get($url, $res)
{
    if ($_SERVER['REQUEST_METHOD'] != "GET") {
        return null;
    }
    if (str_contains($url, '/$')) {
        $data = explode('$', $url);
        $request_uri = $_SERVER['REQUEST_URI'];
        $id = str_replace($data[0], '', $request_uri);
        $url = $data[0] . $id;
    }
    if ($_SERVER['REQUEST_URI'] == $url) {
        if (gettype($res) == "object") {

            $attributes = get_object_vars($res);
            echo "<br>";
            print_r($attributes);
            if (isset($id)) {
                $res($id);
            } else {
                $res();
            }
        } elseif (str_contains($res, ".php")) {
            require_once $res;
        }
    }
}
