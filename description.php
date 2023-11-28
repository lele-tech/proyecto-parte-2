<?php

    require_once './database.php';
    if($_GET){
    $item = $database->select("tb_recipes",[
        "[>]tb_categories"=>["id_category" => "id_category"],
    ],[
        "tb_recipes.id_recipe",
        "tb_recipes.recipe_name",
        "tb_recipes.recipe_description",
        "tb_recipes.recipe_image",
        "tb_recipes.recipe_price",
        "tb_categories.name_category"
    ],[
        "id_recipe"=>$_GET["id"]
    ]);

}
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
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
            ?>
            <div class="description-recipe">
                <div>
                    <h3 class="recipe-title ingredients-text">Ingredientes</h3>
                    <ul class="ingredients-list">
                        <li>
                            <p>2 tazas de arroz de paella</p>
                        </li>
                        <li>
                            <p>500 gramos de mariscos mixtos </p>
                        </li>
                        <li>
                            <p>1 cebolla picada</p>
                        </li>
                        <li>
                            <p>1 pimiento rojo picado</p>
                        </li>
                        <li>
                            <p>1 litro de caldo de pescado o marisco</p>
                        </li>
                        <li>
                            <p>2 tomates maduros, pelados y picados</p>
                        </li>
                        <li>
                            <p>Aceite de oliva virgen extra</p>
                        </li>
                        <li>
                            <p>1/2 taza de guisantes</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        echo "<div class='cta-container'>";
        echo "<a class='btn-recipe nav-list-link' href='book.php?id=". (isset($item[0]["id_recipe"]) ? $item[0]["id_recipe"] : '') ."'>Book</a>";
        echo"</div>";
        ?>
    </section>

    <section>
        <div class="process-container">
            <h3 class="top10-title">Preparacion</h3>
            <p class="recipe-text"> Coloca una paellera (una sartén grande y plana con asas) en el fuego y calienta un
                poco de aceite de
                oliva a fuego medio-alto.

                Añade los mariscos y dóralos brevemente hasta que estén casi cocidos. Luego, retíralos y resérvalos.

                En la misma paellera, añade un poco más de aceite si es necesario y sofríe la cebolla, los pimientos y
                el ajo hasta que estén tiernos y fragantes.

                Agrega el tomate picado y el pimentón dulce. Cocina durante unos minutos hasta que los tomates se hayan
                ablandado y la mezcla tenga un aspecto más espeso.

                Agrega el arroz y revuelve bien para que se impregne con los sabores de los ingredientes sofritos.

                Si estás utilizando hebras de azafrán, agrégalas ahora. También puedes disolverlas en un poco de caldo
                caliente antes de agregarlas al arroz.

                Vierte el caldo de pescado caliente en la paellera y sazona con sal y pimienta al gusto. Lleva la mezcla
                a ebullición y luego reduce el fuego a medio-bajo.

                Cocina a fuego lento durante unos 15-20 minutos, o hasta que el arroz haya absorbido la mayor parte del
                caldo y esté tierno. No revuelvas el arroz con demasiada frecuencia, ya que la paella debe desarrollar
                una capa dorada en la parte inferior conocida como "socarrat".

                Cuando el arroz esté casi cocido, distribuye los mariscos dorados por encima y los guisantes.

                Cubre la paellera con papel de aluminio y deja reposar durante unos minutos fuera del fuego para que los
                sabores se mezclen y el arroz termine de cocinarse.

                Sirve la paella caliente, adornándola con rodajas de limón si lo deseas.</p>
        </div>
    </section>



    <!-- recipes -->
    <section class="top10-container">
        <h1 class="top10-title">Relacionado</h1>
        <div class="recipes-container">
            <section class="recipe">
                <div class="recipe-thumb">
                    <img class="recipe-image" src="./imgs/paella.jpg" alt="PAELLA">
                    <span class="recipe-price">$8</span>
                </div>
                <h3 class="recipe-title">Paella</h3>
                <p class="recipe-text">La paella es un plato español de arroz con pollo, mariscos y especias, cocinado
                    en una sartén grande.</p>
                <!-- buton -->
                <div class="cta-container">
                    <a class="btn-recipe nav-list-link" href="#">Mas</a>
                </div>
                <!-- buton -->
            </section>

            <section class="recipe">
                <div class="recipe-thumb">
                    <img class="recipe-image" src="./imgs/paella.jpg" alt="PAELLA">
                    <span class="recipe-price">$8</span>
                </div>
                <h3 class="recipe-title">Paella</h3>
                <p class="recipe-text">La paella es un plato español de arroz con pollo, mariscos y especias, cocinado
                    en una sartén grande.</p>
                <!-- buton -->
                <div class="cta-container">
                    <a class="btn-recipe nav-list-link" href="#">Mas</a>
                </div>
                <!-- buton -->
            </section>

            <section class="recipe">
                <div class="recipe-thumb">
                    <img class="recipe-image" src="./imgs/paella.jpg" alt="PAELLA">
                    <span class="recipe-price">$8</span>
                </div>
                <h3 class="recipe-title">Paella</h3>
                <p class="recipe-text">La paella es un plato español de arroz con pollo, mariscos y especias, cocinado
                    en una sartén grande.</p>
                <!-- buton -->
                <div class="cta-container">
                    <a class="btn-recipe nav-list-link" href="#">Mas</a>
                </div>
                <!-- buton -->
            </section>

            <section class="recipe">
                <div class="recipe-thumb">
                    <img class="recipe-image" src="./imgs/paella.jpg" alt="PAELLA">
                    <span class="recipe-price">$8</span>
                </div>
                <h3 class="recipe-title">Paella</h3>
                <p class="recipe-text">La paella es un plato español de arroz con pollo, mariscos y especias, cocinado
                    en una sartén grande.</p>
                <!-- buton -->
                <div class="cta-container">
                    <a class="btn-recipe nav-list-link" href="#">Mas</a>
                </div>
                <!-- buton -->
            </section>
        </div>
    </section>
    <!-- recipes -->

    <!-- buton -->
    <div class="cta-container">
        <a class="btn nav-list-link" href="#">Acerca</a>
    </div>
    <!-- buton -->

    <?php 
        include "./parts/footer.php";
    ?>
</body>

</html>