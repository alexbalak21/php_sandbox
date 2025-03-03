<?php
class DB {
    private $db;

    public function __construct() {
        $this->db = require_once "conn_db.php";
    }

    public function init_note (string $title) : int {
        $stmt = $this->db->prepare("INSERT INTO notes (title) VALUES (:title)");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function save_img_to_db($note_id, $imageType, $base64Data) {
        // Save the image data to the database and get the image ID
        $stmt = $this->db->prepare("INSERT INTO images (image_type, image_data, note_id) VALUES (:image_type, :image_data, :note_id)");
        $stmt->bindValue(':image_type', $imageType, PDO::PARAM_STR);
        $stmt->bindValue(':image_data', $base64Data, PDO::PARAM_LOB);
        $stmt->bindValue(':note_id', $note_id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function save_content(int $id = 0, string $content = '') : int {
        if ($id == 0 || $content == '') return 0;
        $stmt = $this->db->prepare("UPDATE notes SET content = :content WHERE id = :id");
        $stmt->bindValue(':content', $content, PDO::PARAM_LOB);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $id;
    }
}

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
    $content = $dom->saveHTML();

    return $content;
}

?>