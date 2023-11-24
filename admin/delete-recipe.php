<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/where
    if($_GET){
        $data = $database->select("tb_recipes","*",[
            "id_recipe"=>$_GET["id"]
        ]);
    }

    if($_POST){
        // Reference: https://medoo.in/api/delete
        $database->delete("tb_recipes",[
            "id_recipe"=>$_POST["id"]
        ]);

        header("location: list-recipes.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Recipe</title>
</head>
<body>
    
    <h2>Delete recipe: <?php echo $data[0]["id_recipe"]; ?></h2>
    <form method="post" action="delete-recipe.php">
        <input name="id" type="hidden" value="<?php echo $data[0]["id_recipe"]; ?>">
        <input type="button" onclick="history.back();" value="CANCEL">
        <input type="submit" value="DELETE">
    </form>
   
</body>
</html>