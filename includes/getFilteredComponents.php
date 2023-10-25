<?php
// Specify the location of your JSON database file
$databaseFile = '../database/database.json';

if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];

    // Read the existing JSON data
    $data = json_decode(file_get_contents($databaseFile), true);

    if (isset($data['components'])) {
        $components = $data['components'];

        // Filter components based on the selected category
        $filteredComponents = array_filter($components, function ($component) use ($selectedCategory) {
            return isset($component['category']) && $component['category'] === $selectedCategory;
        });

        // Create an array to store component data
        $componentData = [];

        foreach ($filteredComponents as $component) {
            $componentData[] = [
                'id' => $component['id'],
                'image' => $component['image'],
            ];
        }

        // Output the component data as JSON
        echo json_encode($componentData);
    }
}
?>
