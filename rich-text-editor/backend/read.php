<?php
// Create or open the SQLite database
$db = new SQLite3('notes.db');

function parseContent(string $content) : string {
    global $db; // Use the global database connection

    // Load the HTML content into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($content);

    // Find all <img> elements with src attributes starting with "id:"
    foreach ($dom->getElementsByTagName('img') as $img) {
        $src = $img->getAttribute('src');
        if (preg_match('/^id=(\d+)$/', $src, $matches)) {
            $imageId = $matches[1]; // Extract the image ID

            // Retrieve the image data from the database
            $stmt = $db->prepare("SELECT image_type, image_data FROM images WHERE id = :id");
            $stmt->bindValue(':id', $imageId, SQLITE3_INTEGER);
            $result = $stmt->execute();
            $image = $result->fetchArray(SQLITE3_ASSOC);

            if ($image) {
                $imageType = $image['image_type'];
                $base64Data = $image['image_data'];

                // Replace the src attribute with the base64 data
                $img->setAttribute('src', "data:$imageType;base64,$base64Data");
            }
        }
    }

    // Save the modified HTML content back to the $content variable
    $content = $dom->saveHTML();

    return $content;
}

// Retrieve all notes from the database
$result = $db->query("SELECT * FROM notes");

// Display each note after parsing the content
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $title = $row['title'];
    $parsedContent = parseContent($row['content']);
    
    echo "<h3>$title</h3>";
    echo $parsedContent;
    echo "<hr>";
}
?>