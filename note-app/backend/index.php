<?php
// CONTROLLER
require_once "db.php";
require_once "Router.php";


$Router = new Router();


define('BASE_URI', "/note-app/backend");

$Router->POST(BASE_URI . '/new', function ($request , $response) {
         $title = $_POST['title'] ?? 'Unnamed note';
         $content = $_POST['editor-content'] ?? '';
         if (empty($content)) return "Cannot save empty note";
         save_note($title, $content); 
});

$Router->GET(BASE_URI . '/', function ($request , $response) {
     $DB = new DB();
    $notes = json_encode($DB->find_all_notes());
    $response->Body($notes);
    $response->send();
});


function wait_for_db($DB, $retries = 5, $delay = 1) {
    while ($retries > 0) {
        if ($DB) {
            return true;
        }
        sleep($delay);
        $retries--;
    }
    return false;
}

function save_note($title, $content) {
    $DB = new DB();
    $note_id = $DB->init_note($title);
    $dom = new DOMDocument();
    @$dom->loadHTML($content);
    $images = $dom->getElementsByTagName('img');

    if ($images->length > 0) 
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/^data:(image\/\w+);base64,/', $src, $matches)) {
                $imageType = $matches[1]; // Extract the image type
                $base64Data = substr($src, strpos($src, ',') + 1); // Extract the base64 data
                $imageId = $DB->save_img_to_db($note_id, $imageType, $base64Data); // Save the image to the database
                // Replace the src attribute with an empty string and add data-id attribute
                $img->setAttribute('src', '');
                $img->setAttribute('data-id', $imageId);
            }
        }
    $content = $dom->saveHTML();
    $rawText = extract_raw_text($dom);
    $DB->save_content($note_id, $content, $rawText);
    return "Note saved successfully";
}

function extract_raw_text($html_content) : string {
    // Extract raw text without HTML tags
    $xpath = new DOMXPath($html_content);
    $rawText = $xpath->evaluate("string(//body)");
    // Convert the raw text to UTF-8 encoding
    $rawText = iconv('UTF-8', 'ISO-8859-1' . '//IGNORE', $rawText);
    echo $rawText;
    return $rawText;
}
?>