<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the category name from the form
    $categoryName = $_POST['category-name'];

    if (!empty($categoryName)) {
        // Specify the location of your JSON database file
        $databaseFile = '../database/database.json';

        // Read the existing JSON data
        $data = json_decode(file_get_contents($databaseFile), true);

        // Create the "categories" array if it doesn't exist
        if (!isset($data['categories'])) {
            $data['categories'] = [];
        }

        // Check if the category name already exists
        if (categoryExists($data['categories'], $categoryName)) {
            echo "<script>alert('Category already exists. Please choose a different name.');</script>";
            echo "<script>window.location.href = '../category.php';</script>";
        } else {
            // Generate a unique 64-character ID
            $uniqueID = bin2hex(random_bytes(32));

            // Add the new category to the "categories" array with the unique ID
            $data['categories'][] = [
                'id' => $uniqueID,
                'name' => $categoryName
            ];

            // Write the updated data back to the JSON file
            file_put_contents($databaseFile, json_encode($data, JSON_PRETTY_PRINT));

            // Redirect to the same page
            header("Location: ../category.php");
        }
    } else {
        echo "Category name cannot be empty.";
    }
}

function categoryExists($categories, $categoryName) {
    foreach ($categories as $category) {
        if ($category['name'] === $categoryName) {
            return true;
        }
    }
    return false;
}
?>
