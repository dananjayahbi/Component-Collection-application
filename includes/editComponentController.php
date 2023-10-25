<?php
// Specify the location of your JSON database file
$databaseFile = '../database/database.json';

// Check if the 'id' parameter is set in the POST data
if (isset($_POST['id'])) {
    $componentId = $_POST['id'];

    // Read the existing JSON data
    $data = json_decode(file_get_contents($databaseFile), true);

    // Find the component with the matching ID
    $selectedComponent = null;
    foreach ($data['components'] as $key => $component) {
        if ($component['id'] === $componentId) {
            $selectedComponent = $component;
            break;
        }
    }

    // Check if a component with the specified ID was found
    if ($selectedComponent) {
        // Update the component with the submitted data
        $data['components'][$key] = array_merge($selectedComponent, $_POST);

        // Save the updated data back to the JSON file
        file_put_contents($databaseFile, json_encode($data, JSON_PRETTY_PRINT));

        // Redirect to the View Component page with the updated component
        header("Location: ../viewComponent.php?id=" . $componentId);
    } else {
        echo 'Component not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
