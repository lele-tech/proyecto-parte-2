<?php
    require_once './database.php';
    // Reference: https://medoo.in/api/select
    
    


    //el que se usa en el keyword
    if(isset($_GET["keyword"]) && isset($_GET["recipe_category"])){

        $items = $database->select("tb_recipes","*",["recipe_name[~]" => $_GET["keyword"],
         "AND"=>[
            "id_category" => $_GET["recipe_category"],
            
            
         ]
         
    ]);
        $category = $database->select("tb_categories","*",["id_category" => $_GET["recipe_category"]]);
        
        
    }else{
        echo "notfound";
    }

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Recipes</title>
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

    <!-- recipes -->
    <section class="top10-container">

            
        
        <h1 class="top10-title">Thes best recipes</h1>

        <?php
            if(count($items)> 0){
            $keyword = htmlspecialchars($_GET["keyword"]);
            echo "<p class='recipe-title'> We found: <span class='recipe-title'>".count($items)."</span> recipes with <span class='recipe-title'>".$keyword. " , ".$category[0]["name_category"]."</span> </p>";
            }
        ?>

    <div class="recipes-container">
        <?php
                if(count($items)> 0){
                  
                    foreach($items as $item){

            echo "<section class='recipe'>";
              echo  "<div class='recipe-thumb'>";
                    echo "<div class='rating'>";
                        echo "<span class='star'></span>";
                    echo "</div>";
                    echo  "<img class='recipe-image' src='./scraping/images/".$item["recipe_image"]."' alt='".$item["recipe_name"]."'>";
                    echo"<span class='recipe-price'>".$item["recipe_price"]."</span>";
               echo "</div>";

                echo "<div>";
                    echo"<a href='destination.php".$url_params."'>".$lang."</a>";
                    echo "<h3 class='recipe-title'>".$item["recipe_name"]."</h3>";
                    echo" <p class='recipe-text'>".substr($item["recipe_description"], 0, 70)."...</p>";
                echo "</div>";
                echo "<ul class='nav-list'>";
                    echo "<li><a class='details' href='#'>".$category[0]["name_category"]."</a></li>";
                    echo "<li><a class='details' href='#'>saber</a></li>";
                echo "</ul>";
                
               echo "<div class=cta-container>";
                    echo "<a class='btn-recipe nav-list-link' href='description.php?id=".$item["id_recipe"]."'>More</a>";
                echo "</div>";
           echo "</section>";

                           
                           
                    }
                }else{
                    $keyword = htmlspecialchars($_GET["keyword"]);
                    echo "<h3 class='activity-title'>No results for ".$keyword." , ".$category[0]["name_category"]. "</h3>";
                }
                    
                ?>
      </div>

    <!-- buton -->
    <div class="cta-container">
        <a class="btn nav-list-link" href="#">Mas</a>
    </div>
    <!-- buton -->

    <?php 
        include "./parts/footer.php";
    ?>
</body>
</html>