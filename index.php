<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/component-card.css">
    <script src="./js/index.js" defer></script>
</head>
<body>
    <!-- Header start -->
    <?php
        include("./header.php");
    ?>
    <!-- Header end -->

    <div class="homeHero">
        <div class="cont">
            <div class="AddBTN">
                <button type="button" id="open-popup-button">Add Component</button>
            </div>

            <form action="#" class="dropForm" method="POST" id="category-form" onsubmit="filterComponents(); return false;">
                <div class="category-dropdown-container">
                    <select name="category" id="category-dropdown">
                        <option value="">All Categories</option>
                        <?php
                        // Specify the location of your JSON database file
                        $databaseFile = './database/database.json';

                        // Read the existing JSON data
                        $data = json_decode(file_get_contents($databaseFile), true);

                        if (isset($data['categories'])) {
                            $categories = $data['categories'];
                            foreach ($categories as $category) {
                                echo '<option value="' . $category['name'] . '">' . $category['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="sbmtBtn">
                    <button type="submit">Find</button>
                </div>
            </form>
        </div>
    </div>

    <div class="component-container" id="component-container">

    </div>

    <script>
        function navToAddComponent() {
            window.location.href = './addComponent.php';
        }

        document.getElementById("open-popup-button").addEventListener("click", navToAddComponent);

        // Function to filter components based on the selected category
        function filterComponents() {
            const categoryDropdown = document.getElementById("category-dropdown");
            const selectedCategory = categoryDropdown.value;
            const componentContainer = document.getElementById("component-container");

            // Fetch components based on the selected category using AJAX
            fetch('./includes/getFilteredComponents.php?category=' + selectedCategory)
                .then(response => response.json())
                .then(data => {
                    componentContainer.innerHTML = ''; // Clear existing components

                    // Create a container div to wrap all the component cards
                    const containerDiv = document.createElement('div');
                    containerDiv.className = 'contain';

                    // Iterate through the component data and create component cards
                    data.forEach(component => {
                        const componentCard = document.createElement('div');
                        componentCard.className = 'component-card';

                        // Create an image element for the preview image
                        const image = document.createElement('img');
                        image.src = './images/componentImages/' + component.image;
                        image.alt = component.image;

                        // Create "View and Update" button
                        const viewUpdateButton = document.createElement('button');
                        viewUpdateButton.className = 'view-update-button';
                        viewUpdateButton.textContent = 'View and Update';
                        viewUpdateButton.addEventListener('click', () => viewAndUpdateComponent(component.id));

                        // Create "Delete" button
                        const deleteButton = document.createElement('button');
                        deleteButton.className = 'delete-button';
                        deleteButton.textContent = 'Delete';
                        deleteButton.addEventListener('click', () => deleteComponent(component.id));

                        componentCard.appendChild(image);
                        componentCard.appendChild(viewUpdateButton);
                        componentCard.appendChild(deleteButton);

                        containerDiv.appendChild(componentCard);
                    });

                    componentContainer.appendChild(containerDiv);
                });
        }


        // Initial load to display all components
        filterComponents();

        function viewAndUpdateComponent(componentId) {
            window.location.href = './ViewComponent.php?id=' + componentId;
        }
    </script>
</body>
</html>
