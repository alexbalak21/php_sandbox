<?php
include "conncetion.php";


/**
 * Creates a new entry in the articles table.
 *
 * @param string $url The URL for the article's page.
 * @param string $title The title of the article.
 * @param array $contents An array of strings representing the article's content.
 * @param array $keywords An array of keywords related to the article.
 *
 * @return bool True on successful insertion, False otherwise.
 */
function create_entry($url = "", $title = "", $contents = [], $keywords = [])
{
    $conn = connect_db();
    if ($conn === null) {
        return false;
    }

    // Validate inputs
    if (empty($url) || empty($title)) {
        error_log("create_entry: URL or title is empty.");
        return false;
    }

    $content = join(" ", $contents);
    $keywordsJson = json_encode($keywords);

    $sql = "INSERT INTO articles (page_url, title, content, keywords) VALUES (:url, :title, :content, :keywords)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':keywords', $keywordsJson);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("create_entry: Failed to insert record. Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Updates an existing entry in the articles table.
 *
 * @param int $id The ID of the article to update.
 * @param string $url The new URL for the article's page.
 * @param string $title The new title for the article.
 * @param array $contents An array of strings representing the updated content.
 * @param array $keywords An array of updated keywords.
 *
 * @return bool True on successful update, False otherwise.
 */
function update_entry($id, $url = "", $title = "", $contents = [], $keywords = [])
{
    $conn = connect_db();
    if ($conn === null) {
        return false;
    }

    if ($id <= 0) {
        error_log("update_entry: Invalid ID.");
        return false;
    }

    $content = join(" ", $contents);
    $keywordsJson = json_encode($keywords);

    $sql = "UPDATE articles 
            SET page_url = :url, title = :title, content = :content, keywords = :keywords
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':keywords', $keywordsJson);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("update_entry: Failed to update record. Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Deletes an entry from the articles table.
 *
 * @param int $id The ID of the record to delete.
 *
 * @return bool True on successful deletion, False otherwise.
 */
function delete_entry($id)
{
    $conn = connect_db();
    if ($conn === null) {
        return false;
    }

    if ($id <= 0) {
        error_log("delete_entry: Invalid ID.");
        return false;
    }

    $sql = "DELETE FROM articles WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("delete_entry: Failed to delete record. Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Reads all entries from the articles table.
 *
 * @return array An array of all records in the articles table.
 */
function read_entries()
{
    $conn = connect_db();
    if ($conn === null) {
        return [];
    }

    $sql = "SELECT * FROM articles";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}
