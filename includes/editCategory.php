<?php
// Specify the location of your JSON database file
$databaseFile = '../database/database.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedCategoryName = $_POST['category-name'];
    $categoryID = $_POST['category-id'];

    if (!empty($updatedCategoryName) && !empty($categoryID)) {
        // Read the existing JSON data
        $data = json_decode(file_get_contents($databaseFile), true);

        if (isset($data['categories'])) {
            foreach ($data['categories'] as &$category) {
                if ($category['id'] === $categoryID) {
                    // Update the category name
                    $category['name'] = $updatedCategoryName;

                    // Save the updated data back to the JSON file
                    file_put_contents($databaseFile, json_encode($data, JSON_PRETTY_PRINT));

                    // Redirect to the same page or another appropriate page
                    header("Location: ../category.php");
                    exit();
                }
            }
        }
    }
}

// If the update fails or the request is invalid, return an error response
http_response_code(400);
exit();
?>
