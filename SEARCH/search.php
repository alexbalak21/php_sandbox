<?php
include "conncetion.php";

$sql = "
  SELECT *
  FROM articles
  WHERE title LIKE :search_term
    OR 'content' LIKE :search_term
    OR JSON_CONTAINS(keywords, :json_search_term)
";

$search_term = isset($_GET['q']) ? trim($_GET['q']) : '';

$results = [];
$pdo = connect_db();
if ($search_term !== '') {
    // Prepare a SQL query with a LIKE clause
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':search_term' => '%' . $search_term . '%',
        ':json_search_term' => json_encode($search_term)
    ]);

    // Fetch all results that match the search term
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search Example</title>
</head>

<body>
    <form method="GET">
        <input type="text" name="q" placeholder="Search..." value="<?php echo htmlspecialchars($search_term); ?>">
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($results)) : ?>
        <ul>
            <?php foreach ($results as $row) : ?>
                <li>
                    <strong><?php echo htmlspecialchars($row['title']); ?></strong>:
                    <?php echo htmlspecialchars($row['content']); ?>
                    <?= $row['keywords'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>
</body>

</html>