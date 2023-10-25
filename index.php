<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/header.css">
    <script src="./js/index.js" defer></script>
</head>
<body>
    <!--Header start-->
    <?php
        include("./header.php")
    ?>
    <!--Header end-->

    <div class="homeHero">
        <div class="addComponentBTN">
            <div class="AddBTN">
                <button type="button" id="open-popup-button">Add Component</button>
            </div>
        </div>
    </div>

    <script>
        function navToAddComponent(){
            window.location.href = './addComponent.php';
        }

        document.getElementById("open-popup-button").addEventListener("click", navToAddComponent);
    </script>
</body>
</html>