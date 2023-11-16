<?php 
    /***
     * 0. include database connection file
     * 1. receive form values from post and insert them into the table (match table field with values from name atributte)
     * 2. for the destination_image insert the value "destination-placeholder.webp"
     * 3. redirect to destinations-list. php after complete the insert into
     */

     require_once './database.php';

     // Reference: https://medoo.in/api/select
     $states = $database->select("tb_categories","*");

     // Reference: https://medoo.in/api/select
     $categories = $database->select("tb_recipes","*");

     $categories_people = $database->select("tb_number_people","*");

     $featureds = array(
        array("id_recipe" => 1, "featured_recipe" => "1"),
        array("id_recipe" => 2, "featured_recipe" => "0")
        // Agrega más elementos según sea necesario
    );

     $message = "";

     if($_POST){

        if(isset($_FILES["recipe_image"])){
            $errors = [];
            $file_name = $_FILES["recipe_image"]["name"];
            $file_size = $_FILES["recipe_image"]["size"];
            $file_tmp = $_FILES["recipe_image"]["tmp_name"];
            $file_type = $_FILES["recipe_image"]["type"];
            $file_ext_arr = explode(".", $_FILES["recipe_image"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = ["jpeg", "png", "jpg", "webp"];

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type is not valid";
                $message = "File type is not valid";
            }

            if(empty($errors)){
                $filename = strtolower($_POST["recipe_name"]);
                $filename = str_replace(',', '', $filename);
                $filename = str_replace('.', '', $filename);
                $filename = str_replace(' ', '-', $filename);
                $img = "location-".$filename.".".$file_ext;
                move_uploaded_file($file_tmp, "../imgs/".$img);

                $database->insert("tb_recipes",[
                    "id_category"=> $_POST["category"],
                    "id_number_people"=>$_POST["people_category"],
                    "recipe_name"=>$_POST["recipe_name"],
                    "featured_recipe"=>$_POST["featured_recipe"],
                    "recipe_description"=>$_POST["recipe_description"],
                    "recipe_image"=> $img,
                    "recipe_price"=>$_POST["recipe_price"]
                ]);
            }
        }
        
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="./css/mainRecipes.css">
</head>
<body>
    <?php 
        include "./parts/header.php";
    ?>
    <div class="container">
        <h2>Add New Recipe</h2>
        <?php 
            echo $message;
        ?>
        <form method="post" action="add-recipe.php" enctype="multipart/form-data">
            <div class="form-items">
                <label for="recipe_name">Recipe name</label>
                <input id="recipe_name" class="textfield" name="recipe_name" type="text">
            </div>
            <div class="form-items">
                <label for="category">Recipe category</label>
                <select name="category" id="category">
                    <?php 
                        foreach($states as $state){
                            echo "<option value='".$state["id_category"]."'>".$state["name_category"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="featured_recipe">Featured Recipe</label>
                <select name="featured_recipe" id="featured_recipe">
                    <?php 
                        foreach($featureds as $featured){
                            echo "<option value='".$featured["id_recipe"]."'>".$featured["featured_recipe"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="people_category">People Category</label>
                <select name="people_category" id="people_category">
                    <?php 
                        foreach($categories_people as $category_people){
                            echo "<option value='".$category_people["id_number_people"]."'>".$category_people["name_number_people"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="recipe_description">Recipe Description</label>
                <textarea id="recipe_description" name="recipe_description" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="form-items">
                <label for="recipe_image">Recipe Image</label>
                <img id="preview" src="../imgs/destination-placeholder.webp" alt="Preview">
                <input id="recipe_image" type="file" name="recipe_image" onchange="readURL(this)">
            </div>
            <div class="form-items">
                <label for="recipe_price">Recipe Price</label>
                <input id="recipe_price" class="textfield" name="recipe_price" type="text">
            </div>
            <div class="form-items">
                <input class="submit-btn" type="submit" value="Add New Recipe">
            </div>
        </form>
    </div>

    <script>
        function readURL(input) {
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    </script>
    
    
    <?php 
        include "./parts/footer.php";
    ?>
</body>
</html>