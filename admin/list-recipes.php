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
     <!-- google fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="../css/mainRecipes.css">
</head>
<body>
    <?php 
        include "../parts/header-admin.php";
    ?>
    <div class ="recipe-admin">
    <h2 class= "top10-title">Registered Recipes</h2>
    <table class= "recipe-thumb">
        <?php
        echo"<table class='recipe-table'>";
            foreach($items as $item){
                echo "<tr>";
                echo "<td class='recipe-title'>".$item["recipe_name"]."</td>";
                echo "<td class='fil'><a class='btn-admin-list nav-list-link ' href='edit-recipe.php?id=".$item["id_recipe"]."'>Edit</a> <a class='btn-admin-list nav-list-link margin-admin' href='delete-recipe.php?id=".$item["id_recipe"]."'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </table>
    </div>
    
    <?php 
        include "../parts/footer.php";
    ?>
</body>
</html>