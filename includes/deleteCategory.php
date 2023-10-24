<?php
// Specify the location of your JSON database file
$databaseFile = '../database/database.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryID = $_POST['category-id'];

    if (!empty($categoryID)) {
        // Read the existing JSON data
        $data = json_decode(file_get_contents($databaseFile), true);

        if (isset($data['categories'])) {
            // Use array_filter to create a new array without the specified category
            $data['categories'] = array_values(array_filter($data['categories'], function ($category) use ($categoryID) {
                return $category['id'] !== $categoryID;
            }));

            // Save the updated data back to the JSON file
            file_put_contents($databaseFile, json_encode($data, JSON_PRETTY_PRINT));

            // Return a success response
            http_response_code(200);
            exit();
        }
    }
}

// If the deletion fails or the request is invalid, return an error response
http_response_code(400);
exit();
