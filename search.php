<?php
    require_once './database.php';
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_recipes","*");

    $categories = $database->select("tb_categories","*");
    
    

     // Reference: https://medoo.in/api/select
     //$categories = $database->select("tb_camping_categories","*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes website</title>
     <!-- google fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="./css/mainRecipes.css">
</head>
<body>
    <main>
        <?php 
         include "./parts/header.php";
        ?>
        <!-- destinations -->
        <section class="recipe search-container">
            
            <div class="recipe-container">
            <h1 class="recipe-title">Find more delicios food</h1>
                <form method= "get" action="topRecipes.php">
                     <label for="search" class="recipe-title">Search</label>
                   <input id="search" class="search" type="text" name="keyword">

                
                    <input type="submit" class="  btn-admin" value="SEARCH RECIPE">

                    <select class= "btn-admin"name="recipe_category" id="recipe_category" class="filter">
                    <?php 
                        foreach($categories as $category){
                            echo "<option value='".$category["id_category"]."'>".$category["name_category"]."</option>";
                        }
                    ?>
                </select>
                </form>

                
                
            </div>


        </section>

    </main>
    <?php 
        include "./parts/footer.php";
    ?>
</body>
</html>