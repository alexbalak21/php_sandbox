<?php
function renderTemplate($filePath) {
    $content = file_get_contents($filePath);

    // Define the custom tags and their replacements
    $tags = [
        '<x-header/>' => 'Header.php'
    ];

    // Replace custom tags with the content of the corresponding files
    foreach ($tags as $tag => $componentFile) {
        if (file_exists($componentFile)) {
            $componentContent = file_get_contents($componentFile);
            $content = str_replace($tag, $componentContent, $content);
        }
    }

    echo $content;
}

// Render the Page.php template
renderTemplate('Page.php');
?>