<?php
// Specify the location of your JSON database file
$databaseFile = './database/database.json';

// Read the existing JSON data
$data = json_decode(file_get_contents($databaseFile), true);

// Initialize an empty array to hold the category names
$categories = [];

if (isset($data['categories'])) {
    $categories = $data['categories'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Component</title>
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
            <h2 id="component-form-title">Add Component</h2>
            <div class="form-content">
                <form action="./includes/addComponentController.php" method="POST" enctype="multipart/form-data">
                    <div class="field" id="categSelect">
                        <label for="category">Select Category:</label>
                        <select id="category" name="category" required>
                            <option disabled>&nbsp;&nbsp;--Select Category--</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field" id="imageUpload">
                        <label for="image">Upload Image:</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="field">
                        <label for="html-code">HTML Code:</label>
                        <textarea id="html-code" name="html-code" rows="6" required placeholder="Paste the HTML code here..."></textarea>
                    </div>
                    <div class="field">
                        <label for="css-code">CSS Code:&nbsp;&nbsp;</label>
                        <textarea id="css-code" name="css-code" rows="6" required placeholder="Paste the CSS code here..."></textarea>
                    </div>
                    <div class="field">
                        <label for="js-code">JS Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <textarea id="js-code" name="js-code" rows="6" required placeholder="Paste the JS code here..."></textarea>
                    </div>
                    <div class="field">
                        <label for="php-1">PHP 1:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <textarea id="php-1" name="php-1" rows="6" placeholder="Paste the PHP code 1 here... (Keep empty if don't have any)"></textarea>
                    </div>
                    <div class="field">
                        <label for="php-2">PHP 2:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <textarea id="php-2" name="php-2" rows="6" placeholder="Paste the PHP code 2 here... (Keep empty if don't have any)"></textarea>
                    </div>
                    <div class="field">
                        <label for="php-3">PHP 3:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <textarea id="php-3" name="php-3" rows="6" placeholder="Paste the PHP code 3 here... (Keep empty if don't have any)"></textarea>
                    </div>
                    <div class="field">
                        <label for="php-4">PHP 4:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <textarea id="php-4" name="php-4" rows="6" placeholder="Paste the PHP code 4 here... (Keep empty if don't have any)"></textarea>
                    </div>
                    <div class="field">
                        <label for="php-5">PHP 5:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <textarea id="php-5" name="php-5" rows="6" placeholder="Paste the PHP code 5 here... (Keep empty if don't have any)"></textarea>
                    </div>
                    <div class="sbmtBTN">
                        <button type="submit" id="sbmt">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form end -->
</body>
</html>