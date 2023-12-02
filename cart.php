<?php
require_once './database.php';

session_start();

$recipe_details = [];
$updateCookie = false;

if (isset($_COOKIE['recipe_data'])) {
    $recipe_details = json_decode($_COOKIE['recipe_data'], true);

    if (isset($_GET["action"]) && $_GET["action"] == "add") {
        // Agrega la receta a la cookie del carrito
        $recipe_details[] = [
            "id_recipe" => $_POST["id_recipe"], 
            "recipe_name" => $_POST["recipe_name"],
            "recipe_price" => $_POST["recipe_price"]
        ];
        $updateCookie = true;
    }

    if ($updateCookie) {
        setcookie('recipe_data', json_encode($recipe_details), time() + 72000);
    }

    if (isset($_GET["action"]) && $_GET["action"] == "delete") {
        $recipeIndexToDelete = $_GET["recipe"];
    
        // Verifica si el índice es válido y existe en el array
        if (isset($recipe_details[$recipeIndexToDelete])) {
            // Elimina la receta del array
            unset($recipe_details[$recipeIndexToDelete]);
    
            // Actualiza la cookie
            setcookie('recipe_data', json_encode($recipe_details), time() + 72000);
    
            // Redirige para evitar reenviar el formulario si el usuario actualiza la página
            header("Location: cart.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
    <main>
        <!-- carrito -->
        <div class="recipes-container">
        <section class="recipe">
            
            <h2 class="top10-title">Tu carrito</h2>

            <div class="recipe">
                <?php
                if($recipe_details == null){
                    echo "<p>No hay recetas en el carrito.</p>";
                }else{
                    echo "<table style='margin-top: 2rem;'>"
                        ."<tr class='item-title'>"
                            ."<td class='recipe-title'>Receta</td>"
                            ."<td class='recipe-title'>Precio</td>"
                        ."</tr>";

                        foreach ($recipe_details as $index=> $recipe){
                            echo "<tr>";
                            echo "<td class='recipe-title'>" . (isset($recipe["recipe_name"]) ? $recipe["recipe_name"] : "") . "</td>";
                            echo "<td>" . (isset($recipe["recipe_price"]) ? "$" . $recipe["recipe_price"] : "") . "</td>";
                            echo "<td><a class=' btn-cart nav-list-link 'href='cart.php?action=delete&recipe=" . $index . "'>Eliminar</a></td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                }
                ?>
            </div>
            <div class='cta-container'>
                <?php 
                    if($recipe_details != null) echo "<div><a class='btn nav-list-link' href='submit-confirmation.php'>I'm ready for booking</a></div>";
                    //unset($_COOKIE['destinations']);
                    //setcookie('destinations', '', time() - 3600);
                ?>
                <div><a class='btn nav-list-link' href='home.php'>Continue exploring recipes</a></div>
            </div>
        </section>
        </div>
        <!-- carrito -->

    </main>

    <?php 
        include "./parts/footer.php";
    ?>
</body>

</html>