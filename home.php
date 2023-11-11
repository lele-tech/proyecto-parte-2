<?php
    require_once './database.php';
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_recipes","*");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="./css/mainRecipes.css">

</head>
</head>

<body>
    <?php 
        include "./parts/header.php";
    ?>
    <div class="home-container">
       <h1 class="home-tittle">The most delicios Spain food</h1>
    </div>

     <!-- recipes -->
     <section class="top10-container">
        <h2 class="top10-title">The most outstanding</h2>
       
        <div class="recipes-container">
        <?php
            foreach($items as $item){
                echo "<section class='recipe'>";
                echo "<div class='recipe-thumb'>";
                echo    "<div class='rating'>";
                        echo "<span class='star' ></span>";
                        echo   "</div>";
                        echo  "<img class='recipe-image' src='./scraping/images/".$item["recipe_image"]."' alt='".$item["recipe_name"]."'>";
                        echo "</div>";

                        echo  "<div>";
                        echo   "<h3 class='recipe-title'>".$item["recipe_name"]."</h3>";
                        echo  "<p class='recipe-text'>".substr($item["recipe_description"], 0, 70)."</p>";
                        echo  "</div>";
                    
                        echo "<div class='cta-container'>";
                        echo  "<a class='btn-recipe nav-list-link' href='.description.php?id=".$item["id_recipe"]."'>More</a>";
                        echo "</div>";
                        echo  "</section>";
                
                    }
        ?>

        </div>
    </section>
    <!-- recipes -->
    

    <!-- recipes -->
    <section class="top10-container">
        <h2 class="top10-title comidas-tittle">Food</h2>
        <div class="recipes-container">
        <?php
            foreach($items as $item){
                echo "<section class='recipe'>";
                echo "<div class='recipe-thumb'>";
                        echo  "<img class='recipe-image' src='./scraping/images/".$item["recipe_image"]."' alt='".$item["recipe_name"]."'>";
                        echo "</div>";

                        echo  "<div>";
                        echo   "<h3 class='recipe-title'>".$item["recipe_name"]."</h3>";
                        echo  "<p class='recipe-text'>".substr($item["recipe_description"], 0, 70)."</p>";
                        echo  "</div>";
                    
                        echo "<div class='cta-container'>";
                        echo  "<a class='btn-recipe nav-list-link' href='.description.php?id=".$item["id_recipe"]."'>More</a>";
                        echo "</div>";
                        echo  "</section>";
                
                    }
        ?>
           
                <!-- buton -->

            </section>
        </div>
    </section>
    <!-- recipes -->

    <!-- buton -->
    <div class="cta-container">
        <a class="btn nav-list-link" href="./topRecipes.php">Acerca</a>
    </div>
    <!-- buton -->

    <?php 
        include "./parts/footer.php";
    ?>
</body>
</html>