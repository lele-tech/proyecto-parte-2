<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_recipes","*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Recipes</title>
    <link rel="stylesheet" href="../css/mainRecipes.css">
</head>
<body>
    <?php 
        include "../parts/header-admin.php";
    ?>
    <h2 class="recipe-title">Registered Recipes</h2>
    <table class="recipe-text">
        <?php
            foreach($items as $item){
                echo "<tr>";
                echo "<td>".$item["recipe_name"]."</td>";
                echo "<td><a href='edit-recipe.php?id=".$item["id_recipe"]."'>Edit</a> <a href='delete-recipe.php?id=".$item["id_recipe"]."'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    <?php 
        include "../parts/footer.php";
    ?>
</body>
</html>