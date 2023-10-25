<?php
// Specify the location of your JSON database file
$databaseFile = './database/database.json';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $componentId = $_GET['id'];

    // Read the existing JSON data
    $data = json_decode(file_get_contents($databaseFile), true);

    // Find the component with the matching ID
    $selectedComponent = null;
    foreach ($data['components'] as $component) {
        if ($component['id'] === $componentId) {
            $selectedComponent = $component;
            break;
        }
    }

    // Check if a component with the specified ID was found
    if ($selectedComponent) {
        $categories = $data['categories'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Component</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/addComponent.css">
</head>
<body>
    <!--Header start-->
    <?php
        include("./header.php")
    ?>
    <!--Header end-->

    <!-- Form -->
    <div class="form-container">
        <div class="addingForm">
            <h2 id="component-form-title">Edit Component</h2>
            <div class="form-content">
                <form action="./includes/editComponentController.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $selectedComponent['id']; ?>">
                    <div class="field" id="categSelect">
                        <label for="category">Select Category:</label>
                        <select id="category" name="category" required>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['name']; ?>" <?php echo ($category['name'] === $selectedComponent['category']) ? 'selected' : ''; ?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field" id="imageUpload">
                        <label for="image">Upload Image:</label>
                        <input type="file" id="image" name="image" accept="./image/componentImages/<?php echo($selectedComponent['image']);?>">
                    </div>
                    <div class="field">
                        <label for="html-code">HTML Code:</label>
                        <textarea id="html-code" name="html-code" rows="6" required><?php echo $selectedComponent['html_code']; ?></textarea>
                    </div>
                    <div class="field">
                        <label for="css-code">CSS Code:</label>
                        <textarea id="css-code" name="css-code" rows="6" required><?php echo $selectedComponent['css_code']; ?></textarea>
                    </div>
                    <div class="field">
                        <label for="js-code">JS Code:</label>
                        <textarea id="js-code" name="js-code" rows="6" required><?php echo $selectedComponent['js_code']; ?></textarea>
                    </div>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <div class="field">
                            <label for="php-<?php echo $i; ?>">PHP <?php echo $i; ?>:</label>
                            <textarea id="php-<?php echo $i; ?>" name="php-<?php echo $i; ?>" rows="6"><?php echo $selectedComponent['php-' . $i]; ?></textarea>
                        </div>
                    <?php endfor; ?>
                    <div class="sbmtBTN">
                        <button type="submit" id="sbmt">Update Component</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form end -->
</body>
</html>

<?php
    } else {
        echo 'Component not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
