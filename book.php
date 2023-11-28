<?php
require_once './database.php';



if ($_GET) {
    // Obtener información sobre la receta seleccionada
    $item = $database->select("tb_recipes", [
        "[>]tb_categories" => ["id_category" => "id_category"],
    ], [
        "tb_recipes.id_recipe",
        "tb_recipes.recipe_name",
        "tb_recipes.recipe_description",
        "tb_recipes.recipe_image",
        "tb_recipes.recipe_price",
        "tb_categories.name_category"
    ], [
        "id_recipe" => $_GET["id"]
    ]);

    

    // Guarda la información de la receta en una cookie
    $recipeData = [
        "id_recipe" => $item[0]["id_recipe"],
        "recipe_name" => $item[0]["recipe_name"],
        "recipe_price" => $item[0]["recipe_price"],
        // ... (otros campos que desees guardar en la cookie)
    ];

    // Codifica y guarda en la cookie llamada 'recipe_data'
    setcookie('recipe_data', json_encode($recipeData), time() + (86400 * 30), "/");

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="./css/mainRecipes.css">
</head>

<body>
    <?php 
        include "./parts/header.php";
    ?>

    <section>
        <div class="recipes-container">
            <?php
                echo "<form method='post' action='cart.php?action=add'>";
                echo "<div class='description-recipe'>";
                echo " <div class='recipe-thumb'>";
                echo "<img class='recipe-image' src='./scraping/images/".$item[0]["recipe_image"]. "'alt='".$item[0]["recipe_name"]."'>";
                echo " <span class='recipe-price'> $".$item[0]["recipe_price"]."</span>";
                echo   "</div>";
                echo "<div>";
                echo  "<h3 class='recipe-title'>".$item[0]["recipe_name"].": (".$item[0]["name_category"].")"."</h3>";
                echo  "<p class='recipe-text'>".$item[0]["recipe_description"]."</p>";
                echo"</div>";
                echo"</div>";
                
                    echo "<input type='hidden' name='id_recipe' value='".$item[0]["id_recipe"]."'>";
                    echo "<input type='hidden' name='recipe_price' value='".$item[0]["recipe_price"]."'>";
                    echo "<input type='hidden' name='recipe_name' value='".$item[0]["recipe_name"]."'>";
                    echo "<div class='cta-container'>";
                    echo "<button class='btn nav-list-link' type='submit'>Agregar al carrito</button>";
                    echo "</div>";
                echo "</form>";

               
            ?>
            
        </div>
    </section>

    

    <?php 
        include "./parts/footer.php";
    ?>
</body>

</html>