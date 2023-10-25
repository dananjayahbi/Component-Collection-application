<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Specify the location of your JSON database file
    $databaseFile = '../database/database.json';

    // Read the existing JSON data
    $data = json_decode(file_get_contents($databaseFile), true);

    // Create the "components" array if it doesn't exist
    if (!isset($data['components'])) {
        $data['components'] = [];
    }

    // Retrieve the form data
    $category = $_POST['category'];
    $htmlCode = $_POST['html-code'];
    $cssCode = $_POST['css-code'];
    $jsCode = $_POST['js-code'];
    $php1 = $_POST['php-1'];
    $php2 = $_POST['php-2'];
    $php3 = $_POST['php-3'];
    $php4 = $_POST['php-4'];
    $php5 = $_POST['php-5'];

    // Handle the uploaded image
    $image = $_FILES['image'];
    if ($image['error'] === UPLOAD_ERR_OK) {
        // Generate a unique ID for the component
        $componentId = bin2hex(random_bytes(16));

        // Get the image file extension
        $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);

        // Rename the image file with the component ID
        $newImageName = $componentId . '.' . $imageExtension;

        // Define the directory where images are stored
        $imageDirectory = '../images/componentImages/';

        // Save the image to the specified directory
        move_uploaded_file($image['tmp_name'], $imageDirectory . $newImageName);

        // Create a new component object
        $component = [
            'id' => $componentId,
            'category' => $category,
            'image' => $newImageName,
            'html_code' => $htmlCode,
            'css_code' => $cssCode,
            'js_code' => $jsCode,
            'php-1' => $php1,
            'php-2' => $php2,
            'php-3' => $php3,
            'php-4' => $php4,
            'php-5' => $php5
        ];

        // Add the component to the "components" array
        $data['components'][] = $component;

        // Write the updated data back to the JSON file
        file_put_contents($databaseFile, json_encode($data, JSON_PRETTY_PRINT));

        // Redirect to the success page or any other appropriate page
        echo "<script>alert('Component Added!');</script>";
        echo "<script>window.location.href = '../addComponent.php';</script>";
    } else {
        // Handle image upload error
        echo "Image upload failed.";
    }
} else {
    echo "Invalid request.";
}
?>