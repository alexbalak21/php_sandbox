<?php
function renderTemplate($filePath) {
    $content = file_get_contents($filePath);

    // Define the custom tags and their corresponding component files
    $tags = [
        'x-header' => 'Header.php'
    ];

    // Replace custom tags with the content of the corresponding files
    foreach ($tags as $tag => $componentFile) {
        // Match the custom tag and extract inner content
        $pattern = '/<' . $tag . '>(.*?)<\/' . $tag . '>/is';
        if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $innerContent = $match[1];

                // Extract inner content as a variable
                $content = $innerContent;

                // Capture the component output
                ob_start();
                include $componentFile;
                $componentContent = ob_get_clean();

                // Replace the custom tag with the component content
                $content = str_replace($match[0], $componentContent, $content);
            }
        }
    }

    echo $content;
}

// Render the Page.php template
renderTemplate('Page.php');
?>