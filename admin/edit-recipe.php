<?php 


     require_once '../database.php';

     // Reference: https://medoo.in/api/select
     $states = $database->select("tb_categories","*");

     // Reference: https://medoo.in/api/select
     $categories = $database->select("tb_recipes","*");

     $categories_people = $database->select("tb_number_people","*");

     $message = "";

     if($_GET){
        $item = $database->select("tb_recipes","*",[
            "id_recipe" => $_GET["id"],
        ]);
     }

     if($_POST){

        $data = $database->select("tb_recipes","*", ["id_recipe"=>$_POST["id"]]);

        if(isset($_FILES["recipe_image"]) && $_FILES["recipe_image"]["name"] != ""){

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
                move_uploaded_file($file_tmp, "../scraping/images/".$img);

               
            }
        }else{
            $img = $data[0]["recipe_image"];
        }
        
        $database->update("tb_recipes",[
            "id_category"=> $_POST["category"],
            "id_number_people"=>$_POST["people_category"],
            "recipe_name"=>$_POST["recipe_name"],
            "featured_recipe"=>$_POST["featured_recipe"],
            "recipe_description"=>$_POST["recipe_description"],
            "recipe_image"=> $img,
            "recipe_price"=>$_POST["recipe_price"]
        ],[
            "id_recipe" => $_POST["id"]
        ]);

        header("location: list-recipes.php");
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
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
    <div class="container">
        <h2>Edit Recipe</h2>
        <?php 
            echo $message;
        ?>
        <form method="post" action="edit-recipe.php" enctype="multipart/form-data">
            <div class="form-items">
                <label for="recipe_name">Recipe Name</label>
                <input id="recipe_name" class="textfield" name="recipe_name" type="text" value="<?php echo $item[0]["recipe_name"] ?>">
            </div>
           
            <div class="form-items">
                <label for="category">Recipe Category</label>
                <select name="category" id="category">
                    <?php 
                        foreach($states as $state){
                            if($item[0]["id_category"] == $state["id_category"]){
                                echo "<option value='".$state["id_category"]."' selected>".$state["name_category"]."</option>";
                            }else{
                                echo "<option value='".$state["id_category"]."'>".$state["name_category"]."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="people_category">People Category</label>
                <select name="people_category" id="people_category">
                    <?php 
                        foreach($categories_people as $category_people){
                            if($item[0]["id_number_people"] == $category_people["id_number_people"]){
                                echo "<option value='".$category_people["id_number_people"]."' selected>".$category_people["id_number_people"]."</option>";
                            }else{
                                echo "<option value='".$category_people["id_number_people"]."'>".$category_people["name_number_people"]."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="recipe_description">Recipe Description</label>
                <textarea id="recipe_description" name="recipe_description" id="" cols="30" rows="10"><?php echo $item[0]["recipe_description"]; ?></textarea>
            </div>
            
            <div class="form-items">
                <label for="recipe_image">Recipe Image</label>
                <img id="preview" src="../scraping/images/<?php echo  $item[0]["recipe_image"] ?>" alt="Preview">
                <input id="recipe_image" type="file" name="recipe_image" onchange="readURL(this)">
            </div>
            <div class="form-items">
                <label for="recipe_price">Recipe Price</label>
                <input id="recipe_price" class="textfield" name="recipe_price" type="text" value="<?php echo $item[0]["recipe_price"] ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $item[0]["id_recipe"]; ?>">
            <div class="form-items">
                <input class="submit-btn" type="submit" value="Update Recipe">
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
        include "../parts/footer.php";
    ?>
</body>
</html>