<?php
// Specify the location of your JSON database file
$databaseFile = './database/database.json';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $componentId = $_GET['id'];

    // Read the existing JSON data
    $data = json_decode(file_get_contents($databaseFile), true);

    if (isset($data['components'])) {
        $components = $data['components'];

        // Find the component with the matching ID
        $selectedComponent = null;
        foreach ($components as $component) {
            if ($component['id'] === $componentId) {
                $selectedComponent = $component;
                break;
            }
        }

        // Check if a component with the specified ID was found
        if ($selectedComponent) {
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>View Component</title>
                <link rel="stylesheet" href="./css/viewComponent.css">
                <link rel="stylesheet" href="./css/header.css">
                <style>
                    pre {
                        background: #f4f4f4;
                        padding: 10px;
                        overflow-x: auto;
                    }
                </style>
            </head>
            <body>
                <a href="javascript:history.back();" class="back-button">Back</a>
                <h1>View Component</h1>
                <p>Category: ' . $selectedComponent['category'] . '</p>';
                
            // Check if an image file exists
            $imagePath = './images/componentImages/' . $selectedComponent['image'];
            if (file_exists($imagePath)) {
                echo '<img id="selectedCompImg" src="' . $imagePath . '" alt="image">';
            } else {
                echo '<p>Image not found</p>';
            }
        
            // Display additional fields as code blocks
            echo '<pre><B>HTML Code:</B><hr> <br><br>' . htmlspecialchars($selectedComponent['html_code']) . '</pre>';
            echo '<pre><B>CSS Code:</B><hr> <br><br>' . htmlspecialchars($selectedComponent['css_code']) . '</pre>';
            echo '<pre><B>JS Code:</B><hr> <br><br>' . htmlspecialchars($selectedComponent['js_code']) . '</pre>';
            echo '<pre><B>PHP-1:</B><hr> <br><br>' . htmlspecialchars($selectedComponent['php-1']) . '</pre>';
            echo '<pre><B>PHP-2:</B><hr> <br><br>' . htmlspecialchars($selectedComponent['php-2']) . '</pre>';
            echo '<pre><B>PHP-3:</B><hr> <br><br>' . htmlspecialchars($selectedComponent['php-3']) . '</pre>';
            echo '<pre><B>PHP-4:</B><hr> <br><br>' . htmlspecialchars($selectedComponent['php-4']) . '</pre>';
            echo '<pre><B>PHP-5:</B><hr> <br><br>' . htmlspecialchars($selectedComponent['php-5']) . '</pre>';
        
            echo '<a href="editComponent.php?id=' . $selectedComponent['id'] . '" class="edit-button">Edit Component</a>';
            echo '
            </body>
            </html>';
        } else {
            // Handle the case where no component with the specified ID was found
            echo 'Component not found.';
        }
    }
} else {
    // Handle the case where no 'id' parameter is set in the URL
    echo 'Invalid request.';
}
?>
