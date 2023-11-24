

<?php
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    
  //el que se usa en el keyword
    if(isset($_GET["keyword"])){

        $items = $database->select("tb_recipes","*",["recipe_name[~]" => $_GET["keyword"]]);

    }else{
        echo "notfound";
    }

    if(isset($_SERVER["CONTENT_TYPE"])){
        $contentType = $_SERVER["CONTENT_TYPE"];

        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));

            $decoded = json_decode($content, true);

          
            $items = $database->select("tb_recipes","*",[ "AND"=>[
                "id_category" => $decoded["category"]
               
            ]
               
            ]);

           /* $state = $database->select("tb_us_states","*",["id_us_state" => $_GET["destination_state"]]);*/

            echo json_encode($items);
        }
    }
    
   
?>


