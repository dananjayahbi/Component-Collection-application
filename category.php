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

// Function to generate category cards with edit and delete buttons
function generateCategoryCards($categories) {
    foreach ($categories as $category) {
        echo '<div class="category-card">';
        echo '<h2>' . $category['name'] . '</h2>';
        echo '<button class="edit-button" onclick="editCategory(\'' . $category['name'] . '\', \'' . $category['id'] . '\')">Edit</button>';
        echo '<button class="delete-button" onclick="deleteCategory(\'' . $category['name'] . '\', \'' . $category['id'] . '\')">Delete</button>';
        echo '</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/category.css">
    <title>Category</title>
</head>
<body>
    <!--Header start-->
    <?php
        include("./header.php")
    ?>
    <!--Header end-->

    <!--Hero section-->
    <div class="categHero">
        <div class="addCategBTNcontainer">
            <div class="AddCategBTN">
                <button type="button" id="open-popup-button">Add Category</button>
            </div>
        </div>
    </div>
    <!--Hero section end-->

    <!-- Display category cards -->
    <div class="category-cards-container">
        <?php generateCategoryCards($categories); ?>
    </div>

    <!-- Popup Form -->
    <div class="popup-form-container" id="popup-form">
        <div class="popup-form">
            <span class="close" onclick="closePopupForm()">&times;</span>
            <h2 id="form-title">Add Category</h2>
            <form id="category-form" method="POST" action="./includes/categorySubmition.php">
                <label for="category-name">Category Name:</label>
                <input type="text" id="category-name" name="category-name" placeholder="Category name" required>
                <input type="hidden" id="category-id" name="category-id" value="">
                <button type="button" id="edit-category-button" onclick="updateCategory()">Update</button>
                <button type="submit" id="submit-category-button">Submit</button>
            </form>
        </div>
    </div>
    <!-- Popup Form end -->

    <script>
        // Function to open the popup form for editing
        function editCategory(categoryName, categoryId) {
            const popupForm = document.getElementById("popup-form");
            const categoryNameInput = document.getElementById("category-name");
            const categoryIdInput = document.getElementById("category-id");
            const editCategoryButton = document.getElementById("edit-category-button");
            const submitCategoryButton = document.getElementById("submit-category-button");
            const formTitle = document.getElementById("form-title");

            // Populate the input field with the category name and ID
            categoryNameInput.value = categoryName;
            categoryIdInput.value = categoryId;

            // Change the button text to "Update"
            editCategoryButton.style.display = "block";
            submitCategoryButton.style.display = "none";
            submitCategoryButton.disabled = true;
            formTitle.textContent = "Edit Category"; // Change the form title

            // Show the form
            popupForm.style.display = "block";
        }

        // Function to open the popup form for adding a new category
        function openPopupForm() {
            const popupForm = document.getElementById("popup-form");
            const categoryNameInput = document.getElementById("category-name");
            const editCategoryButton = document.getElementById("edit-category-button");
            const submitCategoryButton = document.getElementById("submit-category-button");
            const formTitle = document.getElementById("form-title");

            // Clear any previous input value
            categoryNameInput.value = "";

            // Change the form title and show the "Submit" button
            formTitle.textContent = "Add Category";
            submitCategoryButton.style.display = "block";
            submitCategoryButton.disabled = false;

            // Hide the "Update" button
            editCategoryButton.style.display = "none";

            // Show the form
            popupForm.style.display = "block";
        }

        // Function to update the category
        function updateCategory() {
            const categoryNameInput = document.getElementById("category-name");
            const categoryIdInput = document.getElementById("category-id");
            const updatedCategoryName = categoryNameInput.value;

            if (updatedCategoryName) {
                // Set the category ID as a hidden field
                const categoryID = categoryIdInput.value;
                const form = document.getElementById("category-form");
                const hiddenIDInput = document.createElement("input");
                hiddenIDInput.type = "hidden";
                hiddenIDInput.name = "category-id";
                hiddenIDInput.value = categoryID;

                // Change the form's action to "editCategory.php" for editing
                form.action = "./includes/editCategory.php";

                // Append the hidden ID input to the form and submit it
                form.appendChild(hiddenIDInput);
                form.submit();
            } else {
                alert("Category name cannot be empty.");
            }
        }

        // Function to delete a category with confirmation
        function deleteCategory(categoryName, categoryId) {
            if (confirm("Are you sure you want to delete this category?")) {
                // Send an AJAX request to deleteCategory.php
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "./includes/deleteCategory.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Request was successful, refresh the page to update the category list
                        location.reload();
                    } else {
                        // Request failed, handle the error
                        alert("Category deletion failed.");
                    }
                };

                // Send the category ID as a parameter for deletion
                const data = new URLSearchParams();
                data.append("category-id", categoryId);
                xhr.send(data);
            }
        }

        // Function to close the popup form
        function closePopupForm() {
            const popupForm = document.getElementById("popup-form");
            const editCategoryButton = document.getElementById("edit-category-button");
            // Clear the input field
            document.getElementById("category-name").value = "";
            // Change the button text back to "Submit"
            editCategoryButton.style.display = "none";
            // Hide the form
            popupForm.style.display = "none";
        }

        // Add an event listener to open the popup when the button is clicked
        document.getElementById("open-popup-button").addEventListener("click", openPopupForm);
    </script>
</body>
</html>
